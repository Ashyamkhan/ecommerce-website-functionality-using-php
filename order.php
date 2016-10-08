<?php
error_reporting(1);
session_start();
if(!(isset($_SESSION['email'])))
{
header("Location:signin.php");
}
$con=mysqli_connect("localhost","root","","ecommerec");
$email=$_SESSION['email'];
$sql="select product_name,price,image,quantity,quantity*price as subtotal,id from (SELECT p.product_name,p.price,p.image,c.quantity,c.user_email,p.id from products as p
               inner join cart as c 
               on p.id=c.product_id
               where p.id in(select ca.product_id from cart as ca where ca.user_email='$email')) as newtable where user_email='$email'";
//$sql="SELECT * from products as p ,cart as c 
//where p.id in(select product_id from cart  where  user_email='$email')";
//$sql="select p.name,p.price,p.image from products as p
//where p.id in(select product_id from cart  where  user_email='$email')";
$run=mysqli_query($con,$sql);
if(!$run)
echo mysqli_error($con);
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

echo "</table><br/><b></a>&nbsp;&nbsp;&nbsp;Total is $total";
$address="select * from users where user_email='$email'";
$arunaddress=mysqli_query($con,$address);
while($addressrow=mysqli_fetch_array($arunaddress)){
$address=$addressrow['user_address'];
$pincode=$addressrow['user_pincode'];
echo "<br/><br/>Change  Address If You Want Your Order on Other Address<br/><form method='post' action='ordersuccess.php'><br/>Address<input type='text' name='address' value='$address'><br/>
<br/>Pincode<input type='text' name='pincode' value=$pincode><br/><br/><input type='submit' name='buy' value='Buy'></form>";
}
?>