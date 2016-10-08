<?php
session_start();
error_reporting(1);
?>
<html>
<head>
<title>Registration</title>
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript">
/*$(document).ready(function(){
	$(".email").blur (function()
{
	var email=(".email").val();
	//document.write(email);
	$.ajax({
		type:'post',
		url:'email.php',
		data:{user_email:email}
	}).done(function(data){
    $("#em").html(data);
    //alert(data);
	});
});
});
*/
function emai()
{
//	alert("alert");
	var emp=document.getElementById("em").value;
	//alert(emp);
	//document.write(email);
	$.ajax({
		type:'post',
		url:'email.php',
		data:{user_email:emp}
	}).done(function(data){
    //document.getElementById("emps").html(data);
    //alert(data);
    if(data==1){
    	alert('Email Already Exists');
document.getElementById("em").value="";
}
	});
}
function validate()
{
	var mobileno=document.getElementById("mobile").value;
	//document.write(no);
	var pin=document.getElementById("pincode").value;
	if(isNaN(pin))
	{
		alert("Please Enter Number Only in Pin Code");
//document.getElementById("em").innerHTML="Please Enter Number Only in Mobile";
      document.getElementById("pincode").focus();
	return false;
}
	if(isNaN(mobileno))
	{
		alert("Please Enter Number Only in Mobile");
//document.getElementById("em").innerHTML="Please Enter Number Only in Mobile";
      document.getElementById("mobile").focus();
	return false;
}
}
</script>
</head>
<body>
	<?php
include("header.php");
include("sidebar.php");
	?>
	<div class="main-content" >
		<div style="margin-top:520px;">
<center><h2>Registration Form</h2>
<form method="post" action="registration.php" enctype="multipart/form-data" style="background-color:#78B682;height:400px;width:400px;">
	<table cellpadding=10>
<tr><td>Enter Name:</td><td><input type="text" name="user_name"  required><td></tr>
<tr><td>Enter Password:</td><td><input type="password" name="user_password" required></td></tr>
<tr><td>Enter Email:</td><td><input type="email" name="user_email"  id="em" onblur="emai()" minlength="8" required></td></tr>
<tr><td>Enter Address:</td><td><input type="address" name="user_address" required></td></tr>
<tr><td>Enter Pincode:</td><td><input type="text" name="pincode" minlength="6" id="pincode" required></td></tr>
<tr><td>Enter Mobile No:</td><td><input type="text" name="user_mobile" id="mobile" maxlength="10" minlength="10" required></td></tr>
<tr><td><input type="submit" name="user_register" value="Register" onclick=" return validate()"></td></tr>
</form></center>
</div>
</div>
</body>
</html>
<?php
$con=mysqli_connect("localhost","root","","ecommerec");
if(isset($_POST['user_register']))
{
$name=$_POST['user_name'];
$password=md5($_POST['user_password']);
$email=$_POST["user_email"];
$address=$_POST['user_address'];
$pincode=$_POST['pincode'];
$mobile=$_POST['user_mobile'];
$sql="insert into users(user_name,user_password,user_email,user_address,user_pincode,user_mobile) values('$name','$password','$email','$address','$pincode','$mobile')";
$run=mysqli_query($con,$sql);
if(!$run)
echo mysqli_error($con);
if($run)
	{
		echo "<script>alert('Your Are Successfully Registered ')</script>";
        $_SESSION['email']=$email;
        echo "<script>window.open('index.php','_self')</script>";
}}
?>