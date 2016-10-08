<?php
//echo "<script>alert('kbjknb')</script>";
$con=mysqli_connect("localhost","root","","ecommerec");
if(($_POST['prii'])=="")
{
$pp=$_POST['catt'];
//$pn=$_POST['pp'];
//echo $pp;

$sql="select * from products where category_id='$pp'";
$run=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($run))
{
	$name=$row['product_name'];
echo $name;
}

}
if(($_POST['catt'])=="")
{
$pq=$_POST['prii'];
//$pn=$_POST['pp'];
//echo $pp;

$sql="select * from products where price<'$pq'";
$run=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($run))
{
	$name=$row['product_name'];
echo $name;
}

}
if(!(($_POST['catt']=="")&&($_POST['prii'])))
{
		$pp=$_POST['catt'];
		$pq=$_POST['prii'];
$sql="select * from products where category_id='$pp' and price <'$pq'";
$run=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($run))
{
	$name=$row['product_name'];
echo $name;
}		
	}
if(isset($_POST['prii']))
{
	if(isset($_POST['catt']))
	{
		$pp=$_POST['catt'];
		$pq=$_POST['prii'];
$sql="select * from products where category_id='$pp' and price <'$pq'";
$run=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($run))
{
	$name=$row['product_name'];
echo $name;
}		
	}
}
?>