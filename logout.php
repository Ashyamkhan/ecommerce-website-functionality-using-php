<?php
error_reporting(1);
session_start();
$con=mysqli_connect("localhost","root","","ecommerec");
session_destroy();
header("Location:index.php");
?>