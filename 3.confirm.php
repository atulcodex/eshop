<?php
	session_start();
	include 'include/connection.php';
	if (!$_SESSION['customer_email']) 
	{
		header('location:customer_login.php');
		exit();
	}
	if (isset($_GET['orderid'])) 
	{
		$oid = $_GET['orderid'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>confirm payment</title>
	<!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Lobster" rel="stylesheet">
    <style type="text/css">
    	th, td
    	{
    		color: powderblue;
			font-family: 'Do Hyeon', sans-serif;
    	}
    </style>
</head>
<body>
	<form action="3.confirm.php?orderid=<?php echo $oid;?>" method="post">
		<table width="490" border="1" align="center" style="background: url(img/hexa.gif);">
			<tr>
				<th colspan="2">PLEASE CONFIRM PAYMENT</th>
			</tr>
			<tr>
				<td align="right">Invoice No :</td>
				<td><input type="text" name="invoice_no" required></td>
			</tr>
			<tr>
				<td align="right">Amount Paid :</td>
				<td><input type="text" name="paid_amt" required></td>
			</tr>
			<tr>
				<td align="right">Payment Date :</td>
				<td><input type="date" name="date" required></td>
			</tr>
			<tr>
				<td align="right">Total Products :</td>
				<td><input type="text" name="total_qty" required></td>
			</tr>
			<tr>
				<td align="right">Select Payment Mode :</td>
				<td>
					<select name="payment_method" required>
						<option>Paytm</option>
						<option>PayPal</option>
						<option>Visa Card</option>
						<option>Cash On Delivery</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><input type="submit" name="submit" value="confirm"></td>
				<td> <button name="submit"><a href="1.myaccount.php">Go Back</a></button></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php
	if (isset($_POST['submit'])) 
	{
		$ouid = $_GET['orderid'];
		$in = $_POST['invoice_no'];
		$ap = $_POST['paid_amt'];
		$pd = $_POST['date'];
		$tp = $_POST['total_qty'];
		$pm = $_POST['payment_method'];
		$com = 'complete';

		$query = "INSERT INTO payment(invoice_no, amount, date, product_qty, payment_mode) VALUES('$in','$ap','$pd','$tp','$pm')";
		$data = mysqli_query($conn, $query);

		$query1 = "UPDATE c_order SET order_status='$com' WHERE order_id='$ouid'";
		$data1 = mysqli_query($conn ,$query1);

		/*-----------------------updating pending oreder table------------------------------------*/		
		$query2 = "UPDATE pending_orders SET order_status='$com' WHERE order_id='$ouid'";
		$data2 = mysqli_query($conn, $query2);

		if ($data2) 
		{
			echo "<script>alert('payment confirmation successfull, We will verify it in next 24hrs!')</script>";
			echo "<script>window.open('1.myaccount.php','_self')</script>";
		}
		else
		{
			echo "<script>alert('payment confirmation failed!')</script>";
		}
	}
?>