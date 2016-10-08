<html>
<head>
</head>
<body>

<?php
include("header.php");
include("sidebar.php");
?>
<div class="main-content">
<div style="margin-top:520px;">
<?php
error_reporting(1);
$con=mysqli_connect("localhost","root","","ecommerec");
$sql="select * from product_order where status='0'";
//echo $sql;
$run=mysqli_query($con,$sql);
if(mysqli_num_rows($run)==0)
{
echo "<span style='padding-left:100px;'>No Order</span>";
die();	
}
echo "<table cellpadding=10><tr><th>Order Id</th><th>SubTotal</th><th>user Email</th><th>Address</th><th>Staus</th></tr>";
while($row=mysqli_fetch_array($run))
{
	$id=$row['id'];
	$subtotal=$row['subtotal'];
	$user=$row['user_email'];
	$address=$row['address'];

echo "<tr><td>$id</td><td>$subtotal</td><td>$user</td><td>$address</td><td><a href='notifications.php?view=$id'>View</a><td></tr>";
}
echo "</table>";
if(isset($_GET['view']))
{
	$view=$_GET['view'];
	$sql1="update product_order set status='1' where id='$view'";
	$run1=mysqli_query($con,$sql1);
	header("Location:notifications.php","_self");
}
?>
</div>
</div>
</body>
</html>