<?php 
	session_start();
	include 'functions/1.function.php';
	
	if (!$_SESSION['customer_email']) 
	{
		header('location:customer_login.php');
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ecommerce site</title>
	<meta name="viewport" content="width=device-width , initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<!-- Google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Song+Myung|Passion+One|PT+Sans|Sunflower:300" rel="stylesheet">
	<!-- CSS file -->
	<link rel="stylesheet" type="text/css" href="css1/style1.css" media="all">
	<!-- fontawesome -->
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
	<!--favicon -->
	<link rel="shortcut icon" type="image/png" href="img/justano.png">
</head>
<body>
<!---------------------------------top bar------------------------------------>
	<div id="top">
		<?php include 'include/top.php'; ?>
	</div>
<!---------------------------------logo and search box------------------------------------>

	<div id="name">

		<?php 
			
			cart();
		?>
		<form action="search.php" method="get" enctype="multipart/form-data">
		<img src="img/logo.png" alt="logo">
		
			<div class="search-box">
			<input class="search-txt" type="text" name="search" placeholder="What are you looking for?">
			<a class="search-btn" href="search.php">
				<i class="fas fa-search"></i>
			</a>
		</div>
		
		<div id="icon">
			<i class="fas fa-rupee-sign"></i>:<?php total_price(); ?> | <a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart </a> <?php cartitem(); ?> | 
				<?php
					if (!$_SESSION['customer_email']) 
					{
						echo "<a href='customer_login.php'><i class='fas fa-sign-in-alt'></i> login</a>";
					}
					else
					{
						echo "<a href='logout.php'><i class='fas fa-sign-out-alt'></i> logout</a>";
					}
				?>
		</div>
	</form>
	</div>
<!---------------------------------navigation bar------------------------------------>

	<div id="menu">
		<?php include 'include/nav.php'; ?>
	</div>

	<hr>
	<br>
<!---------------------------------image------------------------------------>

	<div id="slide">
		<?php include 'include/slide.php'; ?>
	</div>

	<br>


<!---------------------------------category------------------------------------>

	<div id="cat">
		<?php
			catanbrand();
		?>
	</div>

<!---------------------------------content product box1------------------------------------>

	<div id="content">
		<div id="products_box">
			<?php include 'payment.php'; ?>
		</div>
	</div>



<!---------------------------------ad banner------------------------------------>

<hr>
<br>
	<div id="banner">
		<img src="img/ban1.jpg" width="100%" height="220">
	</div>
<br>
<!---------------------------------category------------------------------------>

	<div id="cat2">
		<img src="img/catban.jpg" alt="banner" height="300">
	</div>

<!---------------------------------body product box2------------------------------------>

	<div id="content2">
		<div id="products_box2">
			<?php
				product_box1();
			?>
		</div>
	</div>

<!---------------------------------sths------------------------------------>

	<div id="sths">
		<br><img src="img/ban2.jpg" width="100%" height="300"><br>
	</div>
<br><br>
<!---------------------------------footer------------------------------------>

	<div id="foot">
		<?php include 'include/foot.php'; ?>
	</div>
</body>
</html>