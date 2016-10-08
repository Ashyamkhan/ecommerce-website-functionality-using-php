<?php
error_reporting(1);
session_start();
?>
<html>
<head><title>Cart Information</title></head>
<body>

	<?php
include("header.php");
include("sidebar.php");?>
	<div class="main-content">
<div style="margin-top:520px;">
		
		<?php
$con=mysqli_connect("localhost","root","","ecommerec");
$ip=$_SERVER['REMOTE_ADDR'];
//echo $ip;

if(isset($_SESSION['email']))
{
		$email=$_SESSION['email'];
	if(isset($_GET['product_id']))
{
$pro_id=$_GET['product_id'];
$delete="delete from cart where user_email='$email' and product_id='$pro_id'";
$delrun=mysqli_query($con,$delete);
if(mysqli_affected_rows($delrun))
	echo "Not Deleted";
}

$sql="select product_name,price,image,quantity,quantity*price as subtotal,id from (SELECT p.product_name,p.price,p.image,c.quantity,c.user_email,p.id from products as p
               inner join cart as c 
               on p.id=c.product_id
               where p.id in(select ca.product_id from cart as ca where ca.user_email='$email')) as newtable where user_email='$email'";
//$sql="SELECT * from products as p ,cart as c 
//where p.id in(select product_id from cart  where  user_email='$email')";
//$sql="select p.name,p.price,p.image from products as p
//where p.id in(select product_id from cart  where  user_email='$email')";
$run=mysqli_query($con,$sql);
$total=0;
echo "<table cellspacing=20><tr><th>Name</th><th>Image</th><th>Price</th><th>quantity</th><th>SubTotal</th></tr>";
while($row=mysqli_fetch_array($run))
{
$title=$row['product_name'];
$price=$row['price'];
$image=$row['image'];
$quantity=$row['quantity'];
$subtotal=$row['subtotal'];
	$total=$total+$subtotal;
	$id=$row['id'];
	echo "<tr><td>$title</td><td> <a href='details.php?cat_id=$id'><img src='images/$image' height=20 width=40></a></td><td>$price</td><td>$quantity</td><td>$subtotal</td>
<td><a href='cart.php?product_id=$id' style='text-decoration:none;'><img src='images/delete.png' height=20 width=20/></a></td>";
}

echo "</table><br/><b>&nbsp;&nbsp;&nbsp;&nbsp;<a href='order.php'>PLACE AN ORDER</a>&nbsp;&nbsp;&nbsp;Total is $total";
//echo "<a href='order.php'>PLACE AN ORDER</a>";
//mysqli_close($con);
}
else
{
//	echo "<table cellpadding=50><th>Sr. No</th><th>Product Name</th><th>Price</th><th>Quantity</th>";
	if(isset($_GET['product_id']))
{
$pro_id=$_GET['product_id'];
$delete1="delete from cart where ip='$ip' and product_id='$pro_id'";
$delrun1=mysqli_query($con,$delete1);
if(mysqli_affected_rows($delrun1))
	echo "Not Deleted";
}

$sql5="select product_name,price,image,quantity,quantity*price as subtotal,id from (SELECT p.product_name,p.price,p.image,c.quantity,c.user_email,p.id,c.ip from products as p
               inner join cart as c 
               on p.id=c.product_id
               where p.id in(select ca.product_id from cart as ca where ca.ip='$ip' and ca.user_email='')) as newtable where ip='$ip' and user_email=''";
//$sql="SELECT * from products as p ,cart as c 
//where p.id in(select product_id from cart  where  user_email='$email')";
//$sql="select p.name,p.price,p.image from products as p
//where p.id in(select product_id from cart  where  user_email='$email')";
$run5=mysqli_query($con,$sql5);
if(!$run5)
echo mysqli_error($con);
$total5=0;
echo "<table cellspacing=20><tr><th>Name</th><th>Image</th><th>Price</th><th>quantity</th><th>SubTotal</th></tr>";
while($row5=mysqli_fetch_array($run5))
{
$title5=$row5['product_name'];
$price5=$row5['price'];
$image5=$row5['image'];
$quantity5=$row5['quantity'];
$subtotal5=$row5['subtotal'];
	$total5=$total5+$subtotal5;
	$id5=$row5['id'];
	echo "<tr><td>$title5</td><td> <a href='details.php?cat_id=$id5'><img src='images/$image5' height=20 width=40></a></td><td>$price5</td><td>$quantity5</td><td>$subtotal5</td>
<td><a href='cart.php?product_id=$id5' style='text-decoration:none;'><img src='images/delete.png' height=20 width=20/></a></td>";
}

echo "</table><br/><b>&nbsp;&nbsp;&nbsp;Total is &nbsp;&nbsp;&nbsp;$total5<br/><br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;<a href='order.php'>PLACE AN ORDER</a>";
}
?>
</div>
</div>
</body>
</html>