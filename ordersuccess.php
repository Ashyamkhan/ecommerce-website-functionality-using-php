<?php
error_reporting(1);
session_start();
//$con=mysqli_connect();
if(isset($_POST['buy']))
{
	$email=$_SESSION['email'];
$con=mysqli_connect("localhost","root","","ecommerec");
$sql="select * from cart where user_email='$email'";

//echo $sql;
$run=mysqli_query($con,$sql);
$dataincart=mysqli_num_rows($run);
//echo $dataincart;
//$datacart=0;
if($dataincart>0)
{
$address=$_POST['address'];
//echo $address;
$pincode=$_POST['pincode'];
while($row=mysqli_fetch_array($run))
{
	$id=$row['product_id'];
	$quantity=$row['quantity'];
	$status=0;
	//echo $quantity;
	$sql2="select price from products where id='$id'";
	$run2=mysqli_query($con,$sql2);
	while($row1=mysqli_fetch_array($run2))
	{
		$price=$row1['price'];
	}
	$subtotal=$quantity*$price;
$sql1="insert into product_order(product_id,quantity,price,subtotal,address,pincode,user_email,status)values('$id','$quantity','$price','$subtotal','$address','$pincode','$email','$status')";
$run3=mysqli_query($con,$sql1);
if(!$run3)
	echo mysqli_error($con);

} 
		echo "<script> alert('Your Order Has Been Placed'); </script>";
		echo "<script>window.open('index.php','_self')</script>";
		//header("location:index.php","_self");
	}
	else
	{
		echo "<script> alert('No Data in the Cart');</script>";
				echo "<script>window.open('index.php','_self')</script>";
		//header("Location:index.php","_self");
	}
}

	?>