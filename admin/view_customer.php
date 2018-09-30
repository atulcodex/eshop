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
			<th colspan="10">CUSTOMER'S DETAIL'S</th>
		</tr>
		<tr>
			<th>ID</th>
			<th>NAME</th>
			<th>EMAIL</th>
			<th>PASSWORD</th>
			<th>COUNTRY</th>
			<th>CITY</th>
			<th>CONTACT</th>
			<th>IMAGE</th>
			<th>IP ADDR</th>
			<th>DELETE</th>
		</tr>
		<?php
			include 'include/connection.php';
			
			$query = "SELECT * FROM customers";
			$data = mysqli_query($conn , $query);
			
			while ($result = mysqli_fetch_assoc($data)) 
			{
				$id = $result['c_id'];
				$name = $result['c_name'];
				$email = $result['c_email'];
				$pass = $result['c_password'];
				$country = $result['c_country'];
				$city = $result['c_city'];
				$contact = $result['c_contact'];
				$add = $result['c_address'];
				$img = $result['c_img'];
				$ip = $result['c_ip'];			
		?>
		<tr align="center">
			<td><?php echo $id; ?></td>
			<td><?php echo $name; ?></td>
			<td><?php echo $email; ?></td>
			<td><?php echo $pass; ?></td>
			<td><?php echo $country; ?></td>
			<td><?php echo $city; ?></td>
			<td><?php echo $contact; ?></td>
			<td><a href="../<?php echo $img; ?>"><img src="../<?php echo $img; ?>" width="70" height="70"></a></td>
			<td><?php echo $ip; ?></td>
			<td><a href="index.php?d_id=<?php echo $id; ?>"><i class="fas fa-trash-alt"></i></a></td>
		</tr>
	<?php } ?>
	</table>
</body>
</html>
