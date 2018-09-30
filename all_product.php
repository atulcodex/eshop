<?php 
	include 'include/connection.php';
	include 'functions/1.function.php';
	session_start();
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
	<link rel="stylesheet" type="text/css" href="css1/style2.css" media="all">
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
		<?php include 'include/name.php'; ?>
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
<!---------------------------------category----------------------------------

	<div id="cat">
		<?php
			catanbrand();
		?>
	</div>

<!---------------------------------content product list------------------------------------>

	<div id="content">
		<div id="products_box">
			<?php
				$query = "SELECT * FROM products";
				$data = mysqli_query($conn , $query);

				
				while ($result = mysqli_fetch_assoc($data)) 
				{
					$p_id = $result['product_id'];
					$p_title = $result['product_title'];
					$c_id = $result['cat_id'];
					$b_id = $result['brand_id'];
					$p_desc = $result['product_desc'];
					$p_price = $result['product_price'];
					$p_img = $result['product_img1'];

					echo "<div id='single_product'>
							 <p id='pname'>$p_title</p>
							 <a href='detail.php?pid=$p_id'>
							 	<img id='pimg' src='admin/$p_img' alt='product_img' width='210' height='200'/>
							 </a>
							 <P>
							 	<a href='detail.php?pid=$p_id'><button>Quick View</button></a>
							 	<i class='fas fa-rupee-sign'> $p_price/-</i>
							 	<a href='index.php?add_cart=$p_id'><button><i class='fas fa-plus'></i><i class='fas fa-shopping-cart'></i></button></a>
							 </p>
						  </div>";
				}
			?>
		</div>
	</div>
</body>
</html>