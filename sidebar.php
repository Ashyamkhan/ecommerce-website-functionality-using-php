<html>
<head>
	<link rel="stylesheet" href="styles/style.css">
	</head>
	<body>
		<?php
        include("functions/function.php");
        //include("header.php");
		?>
		<div class="sidebar">
			<span style="padding:40px;"><b>Categories</b>
			</span>
			<ul>
				<?php
                getCategory();
				?>
			</ul>

		</div>
	</body>
	</html>