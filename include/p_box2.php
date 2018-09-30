<?php
	include 'connection.php';

	$query = "SELECT * FROM products ORDER BY rand() LIMIT 0,5";
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
				 	<img id='pimg' src='admin/$p_img' alt='product_img' width='200' height='250'/>
				 </a>
				 <P>
				 	<a href='detail.php?pid=$p_id'><button>Quick View</button></a>
				 	<i class='fas fa-rupee-sign'> $p_price/-</i>
				 	<a href='index.php?pid=$p_id'><button><i class='fas fa-plus'></i><i class='fas fa-shopping-cart'></i></button>
				 	</a>
				 </p>

			  </div>";
	}
?>