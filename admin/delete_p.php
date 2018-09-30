<?php
	if (isset($_GET['did'])) 
	{
		$id = $_GET['did'];

		$query = "DELETE FROM products WHERE product_id='$id'";
		$data = mysqli_query($conn , $query);

		if ($data) 
		{
			echo "<script>alert('Product deleted successfully')</script>";
			echo "<script>window.open('index.php?view_items','_self')</script>";
		}
	}
?>