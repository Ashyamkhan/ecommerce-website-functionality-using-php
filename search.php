<html>
<head>
<title>Ecommerce</title>
<link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php
include("header.php");
error_reporting(1);
include("sidebar.php");
?>
<div class="main-content" style="margin-top:500px;">
<?php
$con=mysqli_connect("localhost","root","","ecommerec");
	if(!(isset($_GET['pagecat_no']))){
	$search=str_replace(" ", "",$_POST['search']);
}
if(isset($_GET['pagecat_no']))
{
	//$pageno=$_GET['pagecat_no'];
	$page_cat=$_GET['pagecat_no'];	
	$search1=str_replace(" ","",$_GET['sear']);
	$last=$page_cat*6;
	$first=$last-6;
	$sql2="select * from (select p.product_name,p.image,p.price,p.category_id,c.id,c.category_name from products as p
inner join category as c
on p.category_id=c.id) as search where product_name like'%$search1%' or category_name like '%$search1%' limit $first,$last";
$run2=mysqli_query($con,$sql2);

if(!$run2)
echo mysqli_error($con);
while($row1=mysqli_fetch_array($run2))
{
	$name=$row1['product_name'];
	$image=$row1['image'];
	$price=$row1['price'];
	$id=$row1['id'];
	//echo $image;
	echo "<div class='single'><b>&nbsp;&nbsp;&nbsp;&nbsp;$name<br/><br/><img src='images/$image' alt='no image' height=100 width=100/><br/><b>Price:&nbsp;&nbsp;&nbsp;&nbsp;$price";
    echo "<br/><a href='addtocart.php?addtocart=$id'>ADD TO CART</a><br/><a href='details.php?cat_id=$id'>DETAILS</a></div>";

}
$sql5="select * from (select p.product_name,p.image,p.price,p.category_id,c.id,c.category_name from products as p
inner join category as c
on p.category_id=c.id) as search where product_name like'%$search1%' or category_name like '%$search1%'";
$run5=mysqli_query($con,$sql5);
$page5=round(mysqli_num_rows($run5)/6);
$pageno5=6*$page5;
$pagination5=mysqli_num_rows($run5)-$pageno5;

if($pagination5>0)
{
	$page5+=1;
}
if($page5==0)
{
	$page5=1;
}
?>
<div class='pagination'>Pages:
	<?php
for($n1=1;$n1<=$page5;$n1++)
{
	echo "<a href='search.php?pagecat_no=$n1 & sear=$search1' style='text-decoration:none;'>$n1&nbsp;&nbsp;&nbsp;</a>";
}
echo "</div>";



}
else
{
$sql1="select * from (select p.product_name,p.image,p.price,p.category_id,c.id,c.category_name from products as p
inner join category as c
on p.category_id=c.id) as search where product_name like'%$search%' or category_name like '%$search%' limit 0,6";
$run1=mysqli_query($con,$sql1);

if(!$run1)
echo mysqli_error($con);
while($row=mysqli_fetch_array($run1))
{
	$name=$row['product_name'];
	$image=$row['image'];
	$price=$row['price'];
	$iid=$row['id'];
	//echo $image;
	echo "<div class='single'><b>&nbsp;&nbsp;&nbsp;&nbsp;$name<br/><br/><img src='images/$image' alt='no image' height=100 width=100/><br/><b>Price:&nbsp;&nbsp;&nbsp;&nbsp;$price";
    echo "<br/><a href='addtocart.php?addtocart=$iid'>ADD TO CART</a><br/><a href='details.php?cat_id=$iid'>DETAILS</a></div>";
}
$sql="select * from (select p.product_name,p.image,p.price,p.category_id,c.id,c.category_name from products as p
inner join category as c
on p.category_id=c.id) as search where product_name like'%$search%' or category_name like '%$search%'";
$run=mysqli_query($con,$sql);
$page=round(mysqli_num_rows($run)/6);
$pageno=6*$page;
$pagination=mysqli_num_rows($run)-$pageno;

if($pagination>0)
{
	$page+=1;
}
if($page==0)
{
	$page=1;
}
?>
<div class='pagination'>Pages:
	<?php
for($n=1;$n<=$page;$n++)
{
	echo "<a href='search.php?pagecat_no=$n & sear=$search' style='text-decoration:none;'>$n&nbsp;&nbsp;&nbsp;</a>";
}
echo "</div>";


if(mysqli_num_rows($run1)==0)
{
	echo "<center><h3>No Product found for your search</h3><center>";
	exit();
}
}
/*$sql="select * from (select p.product_name,p.image,p.price,p.category_id,c.id,c.category_name from products as p
inner join category as c
on p.category_id=c.id) as search where product_name like'%$search%' or category_name like '%$search%'";
$run=mysqli_query($con,$sql);
$page=round(mysqli_num_rows($run)/6);
$pageno=6*$page;
$pagination=mysqli_num_rows($run)-$pageno;

if($pagination>0)
{
	$page+=1;
}
if($page==0)
{
	$page=1;
}
?>
<div class='pagination'>Pages:
	<?php
for($n=1;$n<=$page;$n++)
{
	echo "<a href='search.php?pagecat_no=$n & sear=$search' style='text-decoration:none;'>$n&nbsp;&nbsp;&nbsp;</a>";
}
echo "</div>";
*/

?>
</div>
</div>
</body>
</html>


