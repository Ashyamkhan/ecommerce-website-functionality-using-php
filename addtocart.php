<?php
//error_reporting(1);
session_start();
$ip=$_SERVER['REMOTE_ADDR'];
$con=mysqli_connect("localhost","root","","ecommerec");
if(isset($_GET['addtocart']))
{
	$product=$_GET['addtocart'];
	//echo $product;
	if(isset($_SESSION['email']))
	{
          //echo "<script>alert('email')</script>";
     $email=$_SESSION['email'];
     $sql="select * from cart where user_email='$email'";
     $run=mysqli_query($con,$sql);
     $insert=0;
     while($row=mysqli_fetch_array($run)){
     	$product_id=$row['product_id'];
     	$quantity=$row['quantity']+1;
     	if($product==$product_id)
     	{
     		$insert=$insert+1;
     		$sql1="update cart set quantity=$quantity where user_email='$email' and product_id='$product_id'";
     		$run1=mysqli_query($con,$sql1);
     		if(!$run)
     			echo mysqli_error($con);
     	}
     }
     if($insert==0)
     {
     	$sql3="insert into cart(quantity,user_email,ip,product_id) values(1,'$email','$ip','$product')";
     	$run3=mysqli_query($con,$sql3);
     	if(!$run3)
     		echo mysqli_error($con);
     }

	}
     else
{
     //echo "<script>alert('em not set')</script>";
 $sql6="select * from cart where ip='$ip' and user_email=''";
     $run6=mysqli_query($con,$sql6);
     $insert6=0;
     while($row6=mysqli_fetch_array($run6)){
          $product_id6=$row6['product_id'];
          $quantity6=$row6['quantity']+1;
          if($product==$product_id6)
          {
               $insert6=$insert6+1;
               $sql5="update cart set quantity=$quantity6 where ip='$ip' and product_id='$product'";
               $run5=mysqli_query($con,$sql5);
               if(!$run5)
                    echo mysqli_error($con);
          }
     }
     if($insert6==0)
     {
          $sql4="insert into cart(quantity,ip,product_id) values(1,'$ip','$product')";
          $run4=mysqli_query($con,$sql4);
          if(!$run4)
               echo mysqli_error($con);
     }    
}
}
echo "<script>history.back();</script>";
//header("location:index.php","_self");

?>