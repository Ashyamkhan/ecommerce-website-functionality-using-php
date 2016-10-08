<?php
$con=mysqli_connect("localhost","root","","ecommerec");
//get the category Name
function getCategory()
{
	global $con;
	$sql="select * from category";
	$run=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run))
	{
	$id=$row['id'];
	$name=$row['category_name'];
	echo "<li><a href='category.php?cat_id=$id'>$name</a></li>";
	}
}

//Print The Products
function getProducts()
{
	global $con;
if(isset($_GET['page_no']))
{
	$page_info=$_GET['page_no'];
	$last=$page_info*6;
	$first=$last-6;
$sqlpage1="select * from products limit $first,$last";
$runpage1=mysqli_query($con,$sqlpage1);
while($row=mysqli_fetch_array($runpage1))
{
	$name=$row['product_name'];
	$image=$row['image'];
	$price=$row['price'];
	$id=$row['id'];
	//echo $image;
	echo "<div class='single'><b>&nbsp;&nbsp;&nbsp;&nbsp;$name<br/><br/><img src='images/$image' alt='no image' height=100 width=100/><br/><b>Price:&nbsp;&nbsp;&nbsp;&nbsp;$price";
    echo "<br/><a href='addtocart.php?addtocart=$id'>ADD TO CART</a><br/><a href='details.php?cat_id=$id'>DETAILS</a></div>";
}
}else{

	$sql="select * from products limit 0,6";
	$run=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($run))
{
	$name=$row['product_name'];
	$image=$row['image'];
	$price=$row['price'];
	$iid=$row['id'];
	//echo $image;
	echo "<div class='single'><b>&nbsp;&nbsp;&nbsp;&nbsp;$name<br/><br/><img src='images/$image' alt='no image' height=100 width=100/><br/><b>Price:&nbsp;&nbsp;&nbsp;&nbsp;$price";
    echo "<br/><a href='addtocart.php?addtocart=$iid'>ADD TO CART</a><br/><a href='details.php?cat_id=$iid'>DETAILS</a></div>";
}
}

}
//Print the products according to category
function getCategoryProducts()
{
	global $con;
$cat_id=$_GET['cat_id'];
//echo $cat_id;
if(isset($_GET['pagecat_no']))
{
	$page_cat=$_GET['pagecat_no'];	
	$last=$page_cat*6;
	$first=$last-6;
	$cat_id1=$_GET['cat_id'];
	//echo $cat_id1;

$sql1="select * from products where category_id='$cat_id1' limit $first,$last";
$run1=mysqli_query($con,$sql1);
while($row=mysqli_fetch_array($run1))
{
$name=$row['product_name'];
	$image=$row['image'];
	$price=$row['price'];
	$id=$row['id'];
	//echo $image;
	echo "<div class='single'><b>&nbsp;&nbsp;&nbsp;&nbsp;$name<br/><br/><img src='images/$image' alt='no image' height=100 width=100/><br/><b>Price:&nbsp;&nbsp;&nbsp;&nbsp;$price";
    echo "<br/><a href='addtocart.php?addtocart=$id'>ADD TO CART</a><br/><a href='details.php?cat_id=$id'>DETAILS</a></div>";
}
getCategoryPage();
/*$cat_id=$_GET['cat_id'];
$sqlpage1="select * from products where category_id='$cat_id'";
$runpage1=mysqli_query($con,$sqlpage1);
$page=round(mysqli_num_rows($runpage1)/6);
$pageno=6*$page;
$pagination=mysqli_num_rows($runpage1)-$pageno;


if($pagination>0)
{
	$page+=1;
}
if($page==0)
{
	$page=1;
}
for($n=1;$n<=$page;$n++)
{
	echo "<a href='category.php?pagecat_no=$n & cat_id=$cat_id' style='text-decoration:none;'>$n&nbsp;&nbsp;&nbsp;</a>";
}
*/
}
else
{
$sql="select * from products where category_id='$cat_id' limit 0,6 ";
$run=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($run))
{
$name=$row['product_name'];
	$image=$row['image'];
	$price=$row['price'];
	$iid=$row['id'];

	//echo $image;
	echo "<div class='single'><b>&nbsp;&nbsp;&nbsp;&nbsp;$name<br/><br/><img src='images/$image' alt='no image' height=100 width=100/><br/><b>Price:&nbsp;&nbsp;&nbsp;&nbsp;$price";
    echo "<br/><a href='addtocart.php?addtocart=$iid'>ADD TO CART</a><br/><a href='details.php?cat_id=$iid'>DETAILS</a></div>";
}
if(mysqli_num_rows($run)==0)
{
	echo "<center><h2>No Product in this Category</h2><center>";
	exit();
}
getCategoryPage();
}

}


function getCategoryPage()
{
	global $con;
$cat_id=$_GET['cat_id'];
$sqlpage1="select * from products where category_id='$cat_id'";
$runpage1=mysqli_query($con,$sqlpage1);
$page=round(mysqli_num_rows($runpage1)/6);
$pageno=6*$page;
$pagination=mysqli_num_rows($runpage1)-$pageno;
?>
<div class="pagination">Pages:
<?php
if($pagination>0)
{
	$page+=1;
}
if($page==0)
{
	$page=1;
}
for($n=1;$n<=$page;$n++)
{
	echo "<a href='category.php?pagecat_no=$n & cat_id=$cat_id' style='text-decoration:none;'>$n&nbsp;&nbsp;&nbsp;</a>";
}
echo "</div>";


}
// pagination
function getPage()
{
	global $con;
/*if(isset($_GET['cat_id'])){
	$cat_id=$_GET['cat_id'];
$sqlpage1="select * from products where category_id='$cat_id'";
$runpage1=mysqli_query($con,$sqlpage1);
$page=round(mysqli_num_rows($runpage1)/6);
$pageno=6*$page;
$pagination=mysqli_num_rows($runpage1)-$pageno;


if($pagination>0)
{
	$page+=1;
}
if($page==0)
{
	$page=1;
}
for($n=1;$n<=$page;$n++)
{
	echo "<a href='index.php?pagecat_no=$n' style='text-decoration:none;'>$n&nbsp;&nbsp;&nbsp;</a>";
}
}*/

$sqlpage="select * from products";
$runpage=mysqli_query($con,$sqlpage);
$page=round(mysqli_num_rows($runpage)/6);
$pageno=6*$page;
$pagination=mysqli_num_rows($runpage)-$pageno;


if($pagination>0)
{
	$page+=1;
}
if($page==0)
{
	$page=1;
}
for($n=1;$n<=$page;$n++)
{
	echo "<a href='index.php?page_no=$n' style='text-decoration:none;'>$n&nbsp;&nbsp;&nbsp;</a>";
}



}
?>