<?php 
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
	<link rel="stylesheet" type="text/css" href="css1/style1.css" media="all">
	<!-- fontawesome -->
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
	<!--favicon -->
	<link rel="shortcut icon" type="image/png" href="img/justano.png">
	<style type="text/css">
		#products_box
		{
			padding-left: 20%;
		}

		table
		{
			border: 1px solid #4081e8;
			width: 700px;
		}
		th,td
		{
			border: 1px solid #4081e8;
			text-align: center;
		}
	</style>
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
			<form action="" method="post" enctype="multipart/form-data">
				<table width="600" bgcolor="powderblue" align="center">
					<tr align="center" >
						<td>REMOVE</td>
						<td>PRODUCTS</td>
						<td>QUANTITY</td>
						<td>PRICE</td>
					</tr>
					<?php
						$cip = getRealIpAdd();    //customer ip address
						$total = 0;

						$query = "SELECT * FROM cart WHERE ip_add='$cip'";
						$data = mysqli_query($conn ,$query);

						while($result = mysqli_fetch_assoc($data)) 
						{
							$pro_id = $result['p_id'];

							$query1 = "SELECT * FROM products WHERE product_id='$pro_id'";
							$data1 = mysqli_query($conn ,$query1);
							
							while ($result1 = mysqli_fetch_assoc($data1)) 
							{
								$pro_price = array($result1['product_price']);
								$p_price = $result1['product_price'];
								$title = $result1['product_title'];
								$img = $result1['product_img1'];


								$sum = array_sum($pro_price);
								$total += $sum;
							
					?>
					<tr align="center" >
						<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
						<td><?php echo $title; ?> <img src="<?php echo "admin/".$img; ?>" width="30" height="30"></td>
						<td><input type="text" name="qty" value="" size="5"></td>
						<?php
							include 'include/connection.php';
							if (isset($_POST['update'])) 
							{
								$qt = $_POST['qty'];

								$query2 = "UPDATE cart SET qty='$qt' WHERE ip_add='$cip' OR p_id='$pro_id'";
								$data2 = mysqli_query($conn , $query2);

								$total = $total*$qt;
								
							}
						?>
						<td><i class='fas fa-rupee-sign'></i> <?php echo $p_price; ?>/-</td>
					</tr>

					<?php
						}
							
						}
					?>

					<tr>
						<td colspan="3">Subtotal</td>
						<td><i class='fas fa-rupee-sign'></i> <?php echo $total;?>/-</td>
					</tr>

					<tr>
						<td><abbr title="update your cart if you want to delete and increase QUANTITY"><input type="submit" name="update" value="update cart"></abbr></td>
						<td colspan="2"><abbr title="Add something extra"><input type="submit" name="continue" value="continue shopping"></abbr></td>
						<td><abbr title="Join payment Getway"><button><a href="checkout.php"> checkout</a></button></abbr></td>
					</tr>
				</table>
			</form>
			<?php
			function update()
			{
			global $conn;
				if (isset($_POST['update'])) 
				{
					foreach ($_POST['remove'] as $remove_id) 
					{
						$query = "DELETE FROM cart WHERE p_id='$remove_id'";
						$data = mysqli_query($conn, $query);

						if ($data) 
						{
							echo "<script>window.open('cart.php','_self')</script>";
						}
					}
				}

				if (isset($_POST['continue'])) 
				{
					echo "<script>window.open('index.php','_self')</script>";;
				}
			}
			echo @$updater = update();	
			?>
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