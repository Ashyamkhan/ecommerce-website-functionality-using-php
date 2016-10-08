<html>
<head>
<title>Ecommerce</title>
<link rel="stylesheet" href="styles/style.css">
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$("select.sortdropcat").change(function(){
var opt=$(".sortdropcat option:selected").val();
	var cat=$(".hide").val();
	$.ajax({
		type:'post',
		url:'sort.php',
		data:{optioncate:opt,category:cat}
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

<input type="hidden" class="hide" value="<?php  echo $_GET['cat_id'] ?>">
<div class="sort">
        <select name="sort" class="sortdropcat" >
        <option>Sort By
        <option value="low">Low TO High</option> 
                <option value="high">High To Low</option> 
                        <option value="relevance">By Relevance</option>
                                <option value="latest">By Latest</option>  
        </select>
		</div>
<div class="main-content">


<?php
//$category_iid=$_GET['cat_id'];
//	echo "cat Id is $category_iid ";
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
//echo $_GET['cat_id'];
getCategoryProducts();
//}
//}
?>
</div>


</div>
<div id="sortby">

	</div>
</body>
</html>