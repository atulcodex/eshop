<?php
	session_start();
	
	if (!$_SESSION['customer_email']) 
	{
		header('location:customer_login.php');
	}
?>
<style type="text/css">
	th,td,#cp
	{
		text-align: center;
		color: powderblue;
		font-family: 'Do Hyeon', sans-serif;
	}
</style>
<?php
	include 'include/connection.php';

	$cemail = $_SESSION['customer_email'];

	$query1 = "SELECT * FROM customers WHERE c_email='$cemail'";
	$data1 = mysqli_query($conn, $query1);

	$result1 = mysqli_fetch_assoc($data1);

	$customer_id = $result['c_id'];
	$customer_name = $result['c_name'];

	$query = "SELECT * FROM c_order WHERE customer_id='$customer_id'";
	$data = mysqli_query($conn , $query);
	
	?>
		<table style="background:url(img/hexa.gif);" width="950" border="1">
			<tr>
				<th>ORDER NO</th>
				<th>DUE AMOUNT</th>
				<th>INVOICE NO</th>
				<th>TOTAL PRODUCTS</th>
				<th>ORDER DATE</th>
				<th>PAID/UNPAID</th>
				<th>STATUS</th>
			</tr>
		
	<?php
	$i =0;
	while ($result = mysqli_fetch_assoc($data)) 
	{
		$oi = $result['order_id'];
		$da = $result['due_amount'];
		$in = $result['invoice_no'];
		$tp = $result['total_products'];
		$od = $result['order_date'];
		$st = $result['order_status'];
		$i++;

		if ($st == 'pending') 
		{
			$st='unpaid';
		}
		else
		{
			$st='paid';
		}
		echo "<tr>
				<td>$i</td>
				<td>$da</td>
				<td>$in</td>
				<td>$tp</td>
				<td>$od</td>
				<td>$st</td>
				<td id='cp'><a href='3.confirm.php?orderid=$oi'>confirm payment</a></td>
			 </tr>";
	}
?></table>