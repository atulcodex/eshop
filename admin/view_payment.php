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
			<th colspan="10">PAYMENT'S DETAIL'S</th>
		</tr>
		<tr>
			<th>PAYMENT NO</th>
			<th>INVOICE NO</th>
			<th>AMOUNT PAID</th>
			<th>DATE</th>
			<th>PRODUCT QTY</th>
			<th>PAYMENT METHOD</th>
		</tr>
		<?php
			include 'include/connection.php';
			$total = 0;
			
			$query = "SELECT * FROM payment";
			$data = mysqli_query($conn , $query);
			
			while ($result = mysqli_fetch_assoc($data)) 
			{
				$id = $result['payment_id'];
				$invoice = $result['invoice_no'];
				$amt = $result['amount'];
				$date = $result['date'];
				$qty = $result['product_qty'];
				$pmode = $result['payment_mode'];

				$num =	array($result['amount']);	
				$sum = array_sum($num);
				$total += $sum;
		?>
		<tr align="center">
			<td><?php echo $id; ?></td>
			<td><?php echo $invoice; ?></td>
			<td><?php echo $amt; ?></td>
			<td><?php echo $date; ?></td>
			<td><?php echo $qty; ?></td>
			<td><?php echo $pmode; ?></td>
		</tr>
	<?php } ?>
	<tr> 
		<td colspan="6" align="center"> TOTAL REVENUE FROM JUSTANO.COM <?php echo " <i class='fas fa-rupee-sign'></i> ".$total."/-"; ?></td>
	</tr>
	</table>
</body>
</html>
