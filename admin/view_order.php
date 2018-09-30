<?php
	session_start();
    include'include/connection.php';  

    if (!$_SESSION['admin_email']) 
    {
      header('location:../index.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		table
		{
			width: 1080px;
		}
		table,th,td
		{
			border: 1px solid black;
			color: powderblue;
			border-radius: 6px;
			border-color: powderblue;
			color: powderblue;
			font-family: 'Do Hyeon', sans-serif;
		}
		table a:link
		{
			color: powderblue;
			text-decoration: none;
		}
	</style>
</head>
<body style="background: url(hexa.gif);">
	<table>
		<tr>
			<th colspan="10">CUSTOMER ORDER'S DETAIL'S</th>
		</tr>
		<tr>
			<th>ORDER NO</th>
			<th>CUSTOMER</th>
			<th>INVOICE NO</th>
			<th>PRODUCT ID</th>
			<th>QTY</th>
			<th>STATUS</th>
			<th>DELETE</th>
		</tr>
		<?php
			include 'include/connection.php';
			
			$query = "SELECT * FROM pending_orders";
			$data = mysqli_query($conn , $query);
			
			while ($result = mysqli_fetch_assoc($data)) 
			{
				$order_id = $result['order_id'];
				$customer_id = $result['customer_id'];
				$invoice = $result['invoice_no'];
				$product_id = $result['product_id'];
				$qty = $result['qty'];
				$status = $result['order_status'];
							
		?>
		<tr align="center">
			<td><?php echo $order_id; ?></td>
			<td>											
				<?php 										//getting customer name
					$nquery = "SELECT * FROM customers WHERE c_id='$customer_id'";
					$ndata = mysqli_query($conn, $nquery);
					$nresult = mysqli_fetch_assoc($ndata);
					$customer_name = $nresult['c_name'];
					echo $customer_name;
				?>
			</td>
			<td><?php echo $invoice; ?></td>
			<td><?php echo $product_id; ?></td>
			<td><?php echo $qty; ?></td>
			<td><?php echo $status; ?></td> 
			<td><a href="index.php?delete_order=<?php echo $order_id; ?>"><i class="fas fa-trash-alt"></i></a></td>
		</tr>
	<?php } ?>
	</table>
</body>
</html>
