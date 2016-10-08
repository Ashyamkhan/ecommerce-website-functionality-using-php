<html>
<head>
	<link rel="stylesheet" href="styles/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
	function review()
	{
		$("#rev").css("display","block");
	}
function image(p)
	{
		//alert(p);
	
        document.getElementById("rating").value=p;
			//alert(p);
		var a=1;
		for(a=1;a<=p;a++)
		{
	document.getElementById(a).src="images/staryellow.jpg";

			//	alert(a);
     //document.write(a);
     
     //$("#a").css("height","20","width","20");
		//a++;
		}


	}
	</script>
	</head>
	<body>
		<?php
include("header.php");		
include("sidebar.php");
		?>
<div class="main-content" style="margin-top:500px;">
<?php
if(isset($_GET['cat_id']))
{
	$cat_id=$_GET['cat_id'];
	$con=mysqli_connect("localhost","root","","ecommerec");
	$insert="update products set views=views+1 where id='$cat_id'";
	$insertrun=mysqli_query($con,$insert);
	$sql="select * from products where id='$cat_id'";
	$run=mysqli_query($con,$sql);
	?>
	<div class="details">
	<?php
	$category="";
	while($row=mysqli_fetch_array($run))
	{$category=$row['category_id'];
		$name=$row['product_name'];
		$image=$row['image'];
		$price=$row['price'];
		$desc=$row['description'];
		$multiple_image=$row['multiple_image'];
       echo "<b>$name</b><br/><img id='main_image' src='images/$image' height=200 width=200><br/><br/>Price:&nbsp;&nbsp;&nbsp;&nbsp;$price<br/><br/>$desc<br/><br/>";
       //echo "<div class='pay'><button>Place An Order</button></div>";
       $arr=explode(",",$multiple_image);
       foreach($arr as $multiple)
       {
       	?>
       	<div onclick="document.getElementById('main_image').src='images/<?php echo $multiple?>'" style="padding-left:0px;float:left;">
       	<?php
       	echo "<img src='images/$multiple' height=80 width=80/></div>";
       }

	}
	?>
</div>
<div>
	
	<button onclick="review()" style="margin-top:100px;">Review</button>
</div>
<div id="rev">
<?php
for($n=1;$n<=5;$n++)
{
	echo "<img src='images/star.png' id='$n' onclick='image($n)' height=20 width=20/>";
	 } 

	 ?>
	 <form method="post" action="" >
	 <input type="hidden" name="ratingas"  id="rating">
	<input type="text" name="message" id="mess" placeholder="what do you think">
	<input type="submit" name="rat" >
</div>
	<?php
$ps="select * from rating where product_id='$cat_id' limit 0,9";
$rp=mysqli_query($con,$ps);
while($rowp=mysqli_fetch_array($rp))
{
	$message=$rowp['rating'];
	$mess=$rowp['message'];
	for($i=1;$i<=$message;$i++)
	{
		echo "<span><img src='images/staryellow.jpg' height=20 width=20 style='float:left;'>";
	}
	echo "<br/>$mess<br/></span>";

}

echo "<div class='recommended'>Recommended Products<br/>";
$sql1="select * from products where category_id='$category' and id!=$cat_id limit 0,4";
$run1=mysqli_query($con,$sql1);
while($row=mysqli_fetch_array($run1))
{
	$image1=$row['image'];
	$name1=$row['product_name'];
	$id=$row['id'];
	echo "<div class='recom'><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$name1 <br/><a href='details.php?cat_id=$id'><img src='images/$image1' height=100 width=100/><br/>
</a><a href='addtocart.php?addtocart=$iid'>ADD TO CART</a>
	</div>";

}
echo "</div>";
}
?>
</div>
	</body>
	</html>
	<?php
if(isset($_POST['rat']))
{
	//echo "<script>alert('nkjnlk')</script>";
	$rat=$_POST['ratingas'];
    //echo $rat;
	$mess=$_POST['message'];
$rating="insert into rating(rating,message,product_id) values('$rat','$mess','$cat_id')";
$ratrun=mysqli_query($con,$rating);
echo "<script>window.open('details.php?cat_id=$cat_id','_self')</script>";
if(!$rattun)
echo mysqli_error($con);
}
	?>