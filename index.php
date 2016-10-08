<html>
<head>
<title>Ecommerce</title>
<link rel="stylesheet" href="styles/style.css">
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$("select.sortdrop").change(function(){
var opt=$(".sort option:selected").val();
	$.ajax({
		type:'post',
		url:'sort.php',
		data:{option:opt}
	}).done(function(data)
	{
		$(".main-content").html(data);
	});
});
});
</script>
</head>
<body>
<?php
include("header.php");
include("sidebar.php");
?>
<div class="sort">
        <select name="sort" class="sortdrop" >
        	<option>Sort By</option>
        <option value="low">Low TO High</option> 
                <option value="high">High To Low</option> 
                        <option value="relevance">By Relevance</option>
                                <option value="latest">By Latest</option>  
        </select>
		</div>
<div class="main-content">

<?php
/*if(isset($_GET['cat_id']))
{
	if(isset($_GET['pagecat_no']))
	{
getCategoryProducts();
}
else
{
	getCategoryProducts();
}
}*/
//elseif(!isset($_GET['cat_id']))
//{
//	if(!isset($_GET['pagecat_no']))
//	{
getProducts();
//}
//}
?>
<div class="pagination">Pages:
	<?php
	
getPage();
?>

</div>
</div>
</body>
</html>