<?php
	if (isset($_GET['delete_bra'])) 
	{
		$id = $_GET['delete_bra'];

		$query = "DELETE FROM brands WHERE brand_id='$id'";
		$data = mysqli_query($conn , $query);

		if ($data) 
		{
			echo "<script>alert('brand deleted successfully')</script>";
			echo "<script>window.open('index.php?view_brand','_self')</script>";
		}
	}
?>