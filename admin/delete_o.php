<?php
	if (isset($_GET['delete_order'])) 
	{
		$id = $_GET['delete_order'];

		$query = "DELETE FROM pending_orders WHERE order_id='$id'";
		$data = mysqli_query($conn , $query);

		if ($data) 
		{
			echo "<script>alert('Order deleted successfully')</script>";
			echo "<script>window.open('index.php?view_orders','_self')</script>";
		}
	}
?>