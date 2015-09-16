<?php
include("config.inc.php");

$results = mysqli_query($connecDB,"SELECT COUNT(*) FROM paginate");
$get_total_rows = mysqli_fetch_array($results); 


$pages = ceil($get_total_rows[0]/$item_per_page);	


if($pages > 1)
{
	$pagination	= '';
	$pagination	.= '<ul class="paginate">';
	for($i = 1; $i<=$pages; $i++)
	{
		$pagination .= '<li><a href="#" class="paginate_click" id="'.$i.'-page">'.$i.'</a></li>';
	}
	$pagination .= '</ul>';
}

?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajax Pagination</title>
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#results").load("fetch_pages.php", {'page':0}, function() {$("#1-page").addClass('active');});  
	
	$(".paginate_click").click(function (e) {
		
		$("#results").prepend('<div class="loading-indication"><img src="ajax-loader.gif" /> Loading...</div>');
		
		var clicked_id = $(this).attr("id").split("-"); 
		var page_num = parseInt(clicked_id[0]); 
		
		$('.paginate_click').removeClass('active'); 
		
       
		$("#results").load("fetch_pages.php", {'page':(page_num-1)}, function(){

		});

		$(this).addClass('active'); 
		
		return false; 
	});	
});
</script>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="results"></div>
<?php echo $pagination; ?>
</body>
</html>
