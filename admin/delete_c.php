<?php
	if (isset($_GET['delete_cat'])) 
	{
		$id = $_GET['delete_cat'];

		$query = "DELETE FROM categories WHERE cat_id='$id'";
		$data = mysqli_query($conn , $query);

		if ($data) 
		{
			echo "<script>alert('Category deleted successfully')</script>";
			echo "<script>window.open('index.php?view_cat','_self')</script>";
		}
	}
?>