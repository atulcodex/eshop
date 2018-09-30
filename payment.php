<?php
	session_start();
	
	if (!$_SESSION['customer_email']) 
	{
		header('location:customer_login.php');
	}
	include 'include/connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a href="img/paytm.jpg"><img src="img/paytm_logo.png" height="60" width="200" /></a><br><br><br><br>
	<a href="img/paytm.jpg"><img src="img/paypal.png" height="60" width="200" /></a><br><br><br><br>
	<a href="img/paytm.jpg"><img src="img/visa.png" height="60" width="200" /></a><br><br><br><br>
	
	<?php
		$ip = getRealIpAdd();

		$query = "SELECT * FROM customers WHERE c_ip='$ip'";
		$data = mysqli_query($conn, $query);
		$result = mysqli_fetch_assoc($data);

		$customer_id = $result['c_id']; 
	?>
	<a href='order.php?cid=<?php echo $customer_id; ?>'><img src="img/cod.png" height="60" width="200" /></a><br><br><br><br>
</body>
</html>