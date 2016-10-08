<?php
session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="styles/style.css">
	</head>
	<body>
		<div class="header">
		<div class="logo">
			<a href="index.php"><img id="main_logo" src="images/a.png"></a>
		</div>
		<div class="menu">
<div class="menu1" style="float:left;padding-top:30px;">

<form method="post" action="search.php">
<input id="search" type="text" name="search" onfocus="document.getElementById('search').style.backgroundColor='yellow'" onblur="document.getElementById('search').style.backgroundColor='white'">
<input id="search_item" type="submit" name="search_items" value="Search Products" style="background:url('images/search1.jpg');">
</form>
</div>
<div class="menu2" style="float:left;padding-top:15px;">
<ul>
<li><a href="index.php">Home</a></li>
<?php if(!(isset($_SESSION['email'])))
{
?>
<li><a href="signin.php">SignIn</a></li>
<?php
}
if(isset($_SESSION['email'])){
?>
<li><a href="logout.php">LogOut</a></li>
<?php
}else {?>
<li><a href="registration.php">Sign Up</a></li>
<?php } ?>
<li><a  href="cart.php" id="crt" onmouseover="imagechange()">Cart</a>
	</li><?php
if((isset($_SESSION['email'])))
{?>
	<li><a  href="user_orders.php">My Orders</a></li>
	<?php

}?>
<?php
error_reporting(1);
if(isset($_SESSION['email'])){
	$email=$_SESSION['email'];
		$con=mysqli_connect("localhost","root","","ecommerec");
	$sql="select * from users where user_email='$email'";
    $run=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run))
	{
		$name=strtoupper($row['user_name']);

	echo "<li style='color:blue;'>Welcome &nbsp;&nbsp;$name </li>";
}

}
?>

</ul>

		</div>

		<div class="banner">
			<img src="images/banner.jpg" style="height:500px; width:1280px;margin-top:32px;margin-left:-300px;">
		</div>
		</div>		
	</body>
	</html>