<?php
	session_start();
	
	if (!$_SESSION['customer_email']) 
	{
		header('location:customer_login.php');
	}
	include 'include/connection.php';
	include 'functions/1.function.php';


	if (isset($_GET['cid'])) 
	{
		$c_id = $_GET['cid'];

		$queryi = "SELECT * FROM customers WHERE c_id = '$c_id'"; //getting customer email for sending order details
		$datai = mysqli_query($conn, $queryi);
		$resulti = mysqli_fetch_assoc($datai);

		$c_email = $resulti['c_email'];
		$c_name = $resulti['c_name'];
	}

	$cip = getRealIpAdd();    //customer ip address
	$total = 0;
	$status = 'pending';
	$i = 0;     //for serial no
	$invoice_no = mt_rand();
	$count_products = mysqli_num_rows();

/*-----------------------------------getting product id where ip address is $cip-----------------------------*/
	$query = "SELECT * FROM cart WHERE ip_add='$cip'";
	$data = mysqli_query($conn ,$query);

	while($result = mysqli_fetch_assoc($data)) 
	{
		$pro_id = $result['p_id'];

		$query1 = "SELECT * FROM products WHERE product_id='$pro_id'";  //getting product price where product id is $pro_id
		$data1 = mysqli_query($conn ,$query1);
				
		while ($result1 = mysqli_fetch_assoc($data1)) 
		{	
			$pro_name = $result1['product_title'];
			$pro_price = array($result1['product_price']);
			$sum = array_sum($pro_price);
			$total += $sum;
			$i++;
		}
				
	}
	

	//Getting quantity from cart
	$query2 = "SELECT * FROM cart WHERE ip_add='$cip'";
	$data2 = mysqli_query($conn , $query2);
	$result2 = mysqli_fetch_assoc($data2);
	$qty = $result2['qty'];

	if ($qty==0) 
	{
		$qty = 1;
		$totalprice = $total;
	}
	else
	{
		$qty = $qty;
		$totalprice = $total*$qty;
	}
/*---------------------------------inserting data into customer order table---------------------------------------*/
	$query3 = "INSERT INTO c_order(customer_id,due_amount,invoice_no,total_products,order_date,order_status) VALUES('$c_id','$totalprice','$invoice_no','$qty',NOW(),'$status')";
	$data3 = mysqli_query($conn, $query3);

	if ($data3) 
	{
		echo "<script>alert('order successfully submited, Thanks!')</script>";
		echo "<script>window.open('1.myaccount.php','_self')</script>";
/*----------------------------Inserting data in to the pending order table-----------------------------------*/
		$query4 = "INSERT INTO pending_orders(customer_id,invoice_no,product_id,qty,order_status) VALUES('$c_id','$invoice_no','$pro_id','$qty','$status')";
		$data4 = mysqli_query($conn ,$query4);

		$query5 = "DELETE FROM cart WHERE ip_add='$cip'"; //deleting order after order data is send to pending order table
		$data5 = mysqli_query($conn, $query5);


		$from = 'abdulppj@gmail.com';
		$sub = 'Justano order details';
		$message = "<html>
					<h2 style='color: #4081e8; font-family: Lobster, cursive;'>Hello $c_name this are the your order detail's which is delivered under 3 working day's. Be ready for payment</h2>
					  <table width='700' align='center' bgcolor='#FFCC99' border='2'>
					  	  <tr><td>your order details from justano</td></tr>
					  	  <tr>
					  	  	<th>Sr.no</th>
					  	  	<th>product no</th>
					  	  	<th>quantity</th>
					  	  	<th>invoice no</th>
					  	  	<th>total amt</th>
					  	  </tr>

					  	  <tr>
					  	  	<td>$i</td>
					  	  	<td>$pro_name</td>
					  	  	<td>$qty</td>
					  	  	<td>$invoice_no</td>
					  	  	<td>$totalprice</td>
					  	  </tr>
					  </table>
					  <h2 style='color: #4081e8; font-family: Lobster, cursive;'>Thank you for using justano.com and confirm your payment's</h2>
				   </html>";

		mail($c_email, $sub, $message, $from);
	}
?>