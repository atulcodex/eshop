<?php
	if (isset($_GET['d_id'])) 
	{
		$id = $_GET['d_id'];

		$query = "DELETE FROM customers WHERE c_id='$id'";
		$data = mysqli_query($conn , $query);

		if ($data) 
		{
			echo "<script>alert('Customer deleted successfully')</script>";
			echo "<script>window.open('index.php?view_customer','_self')</script>";
		}
	}
?>