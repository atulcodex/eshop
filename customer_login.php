<?php
	session_start();
	$conn = mysqli_connect("localhost","root","","eshop");
	function getRealIpAdd()
	{
		//whether ip is from share internet
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   
		  {
		    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
		  }
		//whether ip is from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
		  {
		    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		  }
		//whether ip is from remote address
		else
		  {
		    $ip_address = $_SERVER['REMOTE_ADDR'];
		  }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>login page</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
	<div class="loginbox">
		<img src="img/man.png" class="avatar">

		<h1>Login Here</h1>
		<form action="" method="post">
			<p>Useremail</p>
			<input type="email" name="uemail" placeholder="Useremail">

			<p>Password</p>
			<input type="password" name="password" placeholder="password">

			<input type="submit" name="submit" value="login">

			<br>
			<a href="customer_login.php?forgot_pass"><abbr title="You Don't remember your password"> Lost your password?</abbr></a>
			<br>
			<a href="signup.php"><abbr title="Click to Signup Now"> Don't have an account?</abbr></a>
		</form>
		<?php
			if (isset($_GET['forgot_pass'])) 
			{
				echo "<div>
						<b>Enter Your Email id, So we can send your password to your inbox</b>
							<form action='' method='post'>
								<input type='text' name='cname' placeholder='Enter name' value='' required/>
								<input type='text' name='cemail' placeholder='Enter email' value='' required/>
								<input type='submit' name='forgot' value='send me'/>
							</form>
					 </div>";

				if (isset($_POST['forgot'])) 
				{
					$nm = $_POST['cname'];
					$em = $_POST['cemail'];

					$querys = "SELECT * FROM customers WHERE c_name='$nm' || c_email='$em'";
					$datas = mysqli_query($conn , $querys);
					$results = mysqli_num_rows($datas);
					$cps = $results['c_password'];

					if ($results==1) 
					{
						$from = 'abdulppj@gmail.com';
						$sub = 'justano login password';
						$message = "<html>
									   <h2 style='color: #4081e8; font-family: Lobster, cursive;'>Hello $nm</h2>
									   <h3 style='color: #4081e8; font-family: Lobster, cursive;'>your request for forgot password is accepted</h3>
									   <b style='color: #4081e8; font-family: Lobster, cursive;'>your password is $cps</b>
									   <h3 style='color: #4081e8; font-family: Lobster, cursive;'> thank you for using justano </h3>
									</html>";

						mail($em, $sub, $message, $from);

						echo "<script>alert('Please check your inbox !')</script>";
						echo "<script>window.open('customer_login.php','_self')</script>";
					}
					else
					{
						echo "<script>alert('This username and email is not registered !')</script>";
					}
				}
			}
		?>
	</div>
</body>
</html>
<?php
	if (isset($_POST['submit'])) 
	{
		$email = $_POST['uemail'];
		$pass = $_POST['password'];

		$query1 = "SELECT * FROM customers WHERE c_email='$email' AND c_password='$pass'";
		$data1 = mysqli_query($conn , $query1);
		$result1 = mysqli_num_rows($data1);

		if ($result1==1) 
		{
			$ip = getRealIpAdd();
			$query2 = "SELECT * FROM cart WHERE ip_add='$ip'";
			$data2 = mysqli_query($conn, $query2 );
			$result2 = mysqli_num_rows($data2);
			if ($result2==1) 
			{	
				$_SESSION['customer_email'] = $email;
				echo "<script>window.open('checkout.php','_self')</script>";
				echo "<script>alert('loggedin successfully!')</script>";
			}
			else
			{
				$_SESSION['customer_email'] = $email;
				echo "<script>window.open('1.myaccount.php','_self')</script>";
				echo "<script>alert('loggedin successfully!')</script>";
			}
			
		}
		else
		{
			echo "<script>alert('Wrong email and password!')</script>";
		}	
		
	}
?>