<html>
<head>
<title>Product Insertion</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
function validate()
{
	var x=document.getElementById("pri").value;
var stock=document.getElementById("stock").value;
//	alert(x);
	if(isNaN(x))
	{
		alert("Please Enter Price in Numbers Only");
		x.value="";
		x.focus();
	    return false();
	}
		if(isNaN(stock))
	{
		alert("Please Enter Stock in Numbers Only");
		x.value="";
		x.focus();
	    return false();
	}
}
var n=0;
function plus()
{
	n=n+1;
	if(n<=4)
	{
		
var image=document.createElement("div");
image.setAttribute("id","min"+n);
image.innerHTML="<input type='file' name='file[]''>";
var sp=document.createElement("span");
sp.setAttribute("id","minus"+n);
sp.innerHTML="<img src='images/y.jpg' height=20 width=20 required>";
image.appendChild(sp);
document.getElementById("multiple_image").appendChild(image);
document.getElementById("minus"+n).addEventListener("click",function(){
		 	document.getElementById("min"+n).remove();
		 	n=n-1;
//		 document.getElementById("minus"+n).style.height="150px";
		 });
}
if(n>4)
{
	n=n-1;
	alert("Maximum Five Images Uploaded");
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
	<div class="main-content">
		<div style="margin-top:520px;margin-left:100px;">
<form method="post" action="" enctype="multipart/form-data">
Enter Product Name&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="product" required><br/><br/>
Enter Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="price" id="pri" onblur="return validate()"  required><br/><br/>
Select Cover Image&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="cover" required><br/><br/>
Enter Stock&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="stock" id="stock" onblur="return validate()" required><br/><br/>
Enter Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="desc"></textarea><br/><br/>
Select Category&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="category" required>
<?php
$con=mysqli_connect("localhost","root","","ecommerec");
$sql="select * from category";
$run=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($run))
{
$id=$row['id'];
$name=$row['category_name'];
echo "<option value='$id'>$name</option>";
}
?>
</select><br/><br/>
<div id="multiple_image">Select Thumbnail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="file[]" required><img src="images/x.png" height=20 width=20 onclick="plus()"></div>
<br/><input type="submit" value="Insert" name="insert">
</form>
</div>
</div>
</body>
</html>
<?php
error_reporting(1);
if($_FILES['cover']['name']>1024*1024*2)
{
echo "<script>alert('Too Large Size Of Image.Size should be Above 50MB')</script>";
exit();
}
if(isset($_POST['insert']))
{
	$name=$_POST['product'];
	$price=$_POST['price'];
	$cover=$_FILES['cover']['name'];
	$stock=$_POST['stock'];
	$desc=$_POST['desc'];
	$category=$_POST['category'];
	$multiple=$_FILES['file']['name'];
	//echo basename($multiple,".jpg");
	if(file_exists("images/".$_FILES['cover']['name']))
	{
        $x=mt_rand();
        echo "<script>alert($x)</script>";
        rename("images/".$_FILES['cover']['name'],"images/".$x);
	}
	if(!(move_uploaded_file($_FILES['cover']['tmp_name'],"images/".$_FILES['cover']['name'])))
		echo "not ";
//print_r($_FILES['file']['name']);
$arr=array();
foreach($multiple as $key=>$value)
{
	array_push($arr,$value);
}
$multiple_image=implode(",",$arr);
//echo $multiple_image;
$sql="insert into products(product_name,category_id,price,image,multiple_image,stock,description) values('$name','$category','$price','$cover','$multiple_image','$stock','$desc')";
$run=mysqli_query($con,$sql);
if(!$run)
{
echo mysqli_error($con);
}
else{
  echo	"<script>alert('Successfully Inserted')</script>";
  echo  "<script>window.open('insert.php','_self')</script>";	
	}	

}

?>