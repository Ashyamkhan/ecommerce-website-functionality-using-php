<?php
error_reporting(1);
session_start();
?>
<html>
<head>
<title>
Sign In
</title>
</head>
<body>
<?php
include("header.php");
include("sidebar.php");
?>
<div class="main-content">
	<div style="margin-top:520px;">
<center><h2>Login </h2>
<form method="post" enctype="multipart/form-data">
<table>
<tr><td>Enter Name Or Email:</td><td><input type="text" name="user_name"></td></tr>
<tr><td>Enter Password</td><td><input type="password" name="user_password"></td></tr>
	<tr><td><input type="submit" value="Log In" name="login"></td></tr>
	</form>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST['login']))
{
	$ip=$_SERVER['REMOTE_ADDR'];
	$name=htmlspecialchars($_POST['user_name']);
	$password=htmlspecialchars($_POST['user_password']);
	$con=mysqli_connect("localhost","root","","ecommerec");
	$sql="select * from users where (user_name='$name' or user_email='$name') and user_password='$password'";
	$run=mysqli_query($con,$sql);
	if(mysqli_num_rows($run)>0)
	{
		while($row=mysqli_fetch_array($run)){
		$_SESSION['email']=$row['user_email'];
	}
	$email=$_SESSION['email'];
	$update="update cart set user_email='$email' where ip='$ip'";
	$updaterun=mysqli_query($con,$update);
	header("location:index.php");
	}
	else
		echo "<script>alert('Wrong Password')</script>";
}
?>