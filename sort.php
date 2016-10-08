
<?php
$con=mysqli_connect("localhost","root","","ecommerec");



//echo $sort;
if(isset($_POST['category']))
{
	$sortcat=$_POST['optioncate'];
	$category=$_POST['category'];
switch($sortcat){
case 'low':
$sql="select * from products where category_id='$category' order by price ";
break;
case 'high':
$sql="select * from products where category_id='$category' order by price desc";
break;
case 'relevance':
$sql="select * from products where category_id='$category' order by views desc";
break;
case 'latest':
$sql="select * from products where category_id='$category' order by posted_date  desc";
break;
default:
$sql="select * from products";
break;
}
$run=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($run))
{
	$name=$row['product_name'];
	$image=$row['image'];
	$price=$row['price'];
	$id=$row['id'];
	//echo $image;
	echo "<div class='single'><b>&nbsp;&nbsp;&nbsp;&nbsp;$name<br/><br/><img src='images/$image' alt='no image' height=100 width=100/><br/><b>Price:&nbsp;&nbsp;&nbsp;&nbsp;$price";
    echo "<br/><a href='addtocart.php?addtocart=$id'>ADD TO CART</a><br/><a href='details.php?cat_id=$id'>DETAILS</a></div>";
    
}
//exit();
}
else if(!(isset($_POST['category'])))
{
	$sort=$_POST['option'];
switch($sort){
case 'low':
$sql="select * from products order by price ";
break;
case 'high':
$sql="select * from products order by price desc";
break;
case 'relevance':
$sql="select * from products order by views desc";
break;
case 'latest':
$sql="select * from products order by posted_date  desc";
break;
default:
$sql="select * from products";
break;
}
$run=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($run))
{
	$name=$row['product_name'];
	$image=$row['image'];
	$price=$row['price'];
	$id=$row['id'];
	//echo $image;
	echo "<div class='single'><b>&nbsp;&nbsp;&nbsp;&nbsp;$name<br/><br/><img src='images/$image' alt='no image' height=100 width=100/><br/><b>Price:&nbsp;&nbsp;&nbsp;&nbsp;$price";
    echo "<br/><a href='addtocart.php?addtocart=$id'>ADD TO CART</a><br/><a href='details.php?cat_id=$id'>DETAILS</a></div>";
    
}
}

mysqli_close($con);

?>