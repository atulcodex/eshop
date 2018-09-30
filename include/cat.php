<ul id="head" >
	<li><img src="img/suit.png"> Top Category Formal's</li>
</ul>
<ul id="head2">
	<?php
		include 'connection.php';

		$query = "SELECT * FROM categories";
		$data = mysqli_query($conn , $query);

		while ($result = mysqli_fetch_assoc($data)) 
		{
			$id = $result['cat_id'];
			$title = $result['cat_title'];

			echo" <li><a href='index.php?cat_id=$id'> <img src='img/suit1.png' alt='suitname'> $title </a></li>";
		}
	?>
</ul>

<ul id="head" >
	<li><img src="img/trousers.png"> Top Brands Of Suit's</li>
</ul>

<ul id="head2">
	
	<?php
		include 'connection.php';

		$query = "SELECT * FROM brands";
		$data = mysqli_query($conn , $query);

		while ($result = mysqli_fetch_assoc($data)) 
		{
			$id = $result['brand_id'];
			$title = $result['brand_title'];

			echo" <li><a href='index.php?bra_id=$id'> <img src='img/suit1.png' alt='suitname'> $title</a></li>";
		}
	?>
</ul>