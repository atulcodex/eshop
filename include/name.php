<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="search.php" method="get" enctype="multipart/form-data">
		<abbr title="justano formal's"><img src="img/logo.png" alt="logo"></abbr>
		
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

</body>
</html>