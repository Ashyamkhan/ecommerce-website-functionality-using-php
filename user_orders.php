<html>
</head>
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
session_start();
$email=$_SESSION['email'];
$con=mysqli_connect("localhost","root","","ecommerec");
$sql="select * from product_order where user_email='$email'";
$run=mysqli_query($con,$sql);
echo "<h2 style='color:blue;padding-top:10px;''><center>Your Orders</center></h2><table cellpadding=35>";
echo "<tr><th>S.No</th><th>Product Image</th><th>Quantity</th><th>SubTotal</th><th>Order Date</th><th>Order Status</th><th>Return</th></tr>";
$n=1;
while($row=mysqli_fetch_array($run))
{
$product_id=$row['product_id'];
$sql1="select image from products where id='$product_id'";
$run1=mysqli_query($con,$sql1);

while($row1=mysqli_fetch_array($run1))
{
	$image=$row1['image'];
}
$quantity=$row['quantity'];
$subtotal=$row['subtotal'];
$date=$row['order_date'];
$status=$row['placed'];
if($status==0)
	$st="Pending";
else
	$st="Order Completed";
echo "<tr><td>$n</td><td><a href='details.php?cat_id=$product_id'><img src='images/$image' height=20 width=20/></td><td>$quantity</td><td>$subtotal</td><td>$date</td><td>$st</td><td><a href=''>Return</a></td></tr>";
$n=$n+1;
}
echo "</table>";
?>
</div>
</div>
</body>
</html>