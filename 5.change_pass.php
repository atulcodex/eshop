<?php
	@session_start();
	
    include 'include/connection.php';
    if (isset($_GET['edit_account'])) 
	{
		$email = $_SESSION['customer_email'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="" >
		<table border="1" width="500">
			<tr>
				<td align="center" colspan="2">CHANGE YOUR PASSWORD</td>
			</tr>

			<tr>
				<td align="right">Old Password:</td>
				<td><input type="text" name="opsw" required></td>
			</tr>

			<tr>
				<td align="right">New Password :</td>
				<td><input type="password" name="npsw" required></td>
			</tr>

			<tr>
				<td align="right">Re-Enter New Password:</td>
				<td><input type="password" name="rpsw" required></td>
			</tr>

			<tr>
				<td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php
	if (isset($_POST['submit'])) 
	{
		$em = $email;
		$nps = $_POST['npsw'];

		$query = "UPDATE customers SET c_password='$nps' WHERE c_email='$em'";
		$data = mysqli_query($conn, $query);

		if ($data) 
		{
			echo "<script>alert('Password changed successfully!')</script>";
    		echo "<script>window.open('1.myaccount.php','_self')</script>";	
		}
		else
		{
			echo "<script>alert('Password Not changed')</script>";
		}
	}
?>