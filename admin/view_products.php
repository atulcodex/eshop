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
	<title>view data</title>
	<style type="text/css">
		table,tr,td,th
		{
			border: 1px solid powderblue;
			margin: 2px;
			border-radius: 6px;
			color: powderblue;
			font-family: 'Do Hyeon', sans-serif;
		}

		td a:link
		{
			text-decoration: none;
			color: powderblue;
		}
		
	</style>
</head>
<body>
	
	<table width="1070" style="background: url(hexa.gif);">
		<tr>
			<th>PRODUCT ID</th>
			<th>SUIT NAME</th>
			<th>IMAGE</th>
			<th>PRICE</th>
			<th>TOTAL SOLD</th>
			<th>STATUS</th>
			<th colspan="2">OPERATION</th>
		</tr>
		<?php
    		include 'include/connection.php';
		
    		$query = "SELECT * FROM products";
    		$data = mysqli_query($conn, $query);
    		
    		while ($result = mysqli_fetch_array($data)) 
    		{
    			$pi = $result['product_id'];
    			$pt = $result['product_title'];
    			$pimg = $result['product_img1'];
    			$pp = $result['product_price']; 
    			$ps = $result['status'];   			    			    		
		?>
		<tr align="center">
			<td><?php echo $pi; ?></td>
			<td><?php echo $pt; ?></td>
			<td><a href="<?php echo $pimg; ?>"><img src="<?php echo $pimg; ?>" width='60' height='60'></a></td>
			<td><?php echo $pp; ?></td>
			<td>
			<?php
				$query1 = "SELECT * FROM pending_orders WHERE product_id='$pi'";
				$data1 = mysqli_query($conn , $query1);
				$total = mysqli_num_rows($data1);

				echo $total;
			?>
			</td>
			<td><?php echo $ps; ?></td>
			<td><a href="index.php?eid=<?php echo $pi; ?>"><i class="fas fa-pen-alt"></i></a></td>
			<td><a href="index.php?did=<?php echo $pi; ?>"><i class="fas fa-trash-alt"></i></a></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>