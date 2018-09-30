<?php
	@session_start();
    
    if (!$_SESSION['customer_email']) 
    {
        header('location:customer_login.php');
    }
    include 'include/connection.php';


	if (isset($_GET['edit_account'])) 
	{
		$email = $_SESSION['customer_email'];

		$query1 = "SELECT * FROM customers WHERE c_email='$email'";
		$data1 = mysqli_query($conn, $query1);
		$result1 = mysqli_fetch_assoc($data1);

		$id = $result1['c_id'];
		$nm = $result1['c_name'];
		$em = $result1['c_email'];
		$ps = $result1['c_password'];
		$co = $result1['c_country'];
		$ci = $result1['c_city'];
		$mo = $result1['c_contact'];
		$ad = $result1['c_address'];
		$img = $result1['c_img'];
	}	
?>
<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 80%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 80%;
    }
}
</style>
<body>

<form action="" method="post" enctype="multipart/form-data" style="border:1px solid #ccc">
  <div class="container">
    <h1>Update Form</h1>
    <p>Please change in this form detail to update profile.</p>
    <hr>

    <label for="name"><b>Name</b></label>
    <input type="text" name="name" value="<?php echo $nm; ?>" >

    <label for="email"><b>Email</b></label>
    <input type="text" name="email" value="<?php echo $em; ?>" >

    <label for="psw"><b>Password</b></label>
    <input type="text" name="psw" value="<?php echo $ps; ?>" >

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" name="psw-repeat" value="<?php echo $ps; ?>" >

    <label for="country"><b>Country</b></label>
    <input type="text" name="country" value="<?php echo $co; ?>">

    <label for="city"><b>City / Village</b></label>
    <input type="text" name="city" value="<?php echo $ci; ?>" >

    <label for="mobile"><b>Mobile No</b></label>
    <input type="text" name="mobile" value="<?php echo $mo; ?>" >

    <label for="address"><b>Address</b></label>
    <input type="text" name="address" value="<?php echo $ad; ?>" >

    <label for="image"><b>Choose Your Image</b></label>
    <input type="file" name="uploadfile" ><img src="<?php echo $img; ?>" width="50" height="50"><br><br>

    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    
    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <a href="customer_login.php"><button type="button" class="cancelbtn">Cancel</button></a>
      <button type="submit" name="submit" class="signupbtn">Update Profile</button>
    </div>
  </div>
</form>
</body>
</html>
<?php
    if (isset($_POST['submit'])) 
    {
    	include 'include/connection.php';

    	$uid = $id;
    	$unm = $_POST['name'];   
    	$uem = $_POST['email'];
    	$ups = $_POST['psw'];
    	$uci = $_POST['city'];
    	$umo = $_POST['mobile'];
    	$uad = $_POST['address'];

    	$filename = $_FILES['uploadfile']['name'];
    	$tempname = $_FILES['uploadfile']['tmp_name'];
    	$folder = "customer_img/".$filename;

    	$up_query = "UPDATE customers SET c_name='$unm',c_email='$uem',c_password='$ups',c_city='$uci',c_contact='$umo',c_address='$uad',c_img='$folder' WHERE c_id='$uid'";
    	$run_q=mysqli_query($conn, $up_query);
    	move_uploaded_file($tempname, $folder);

    	if ($run_q) 
    	{
    		echo "<script>alert('Profile updated successfully')</script>";
    		echo "<script>window.open('1.myaccount.php','_self')</script>";	
    	}
    	else
    	{
    		echo "<script>alert('update failed')</script>";
    	}
    }

?>