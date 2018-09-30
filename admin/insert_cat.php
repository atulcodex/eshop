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
	<!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="font/css/all.min.css"/>
	<style type="text/css">
		input[type=text]
		{
			width: 25%;
			border: 2px solid #aaa;
			border-radius: 4px;
			margin: 8px 0;
			outline: none;
			padding: 10px;
			box-sizing: border-box;
			transition:.3s;
		}

		input[type=text]:focus
		{
			border-color: dodgerBlue;
			box-shadow: 0 0 8px 0 dodgerBlue;
		}

		.inputWithIcon input[type=text]
		{
			padding-left: 40px;
		}

		.inputWithIcon
		{
			position: relative;
		}

		.inputWithIcon i
		{
			position: absolute;
			left: 410px;
			top: 8px;
			padding: 28px 8px;
			color: #aaa;
		}

		.inputWithIcon input[type=text]:focus + i
		{
			color: dodgerBlue;
		}

		.button1 {
	    background-color: #4CAF50; /* Green */
	    border: none;
	    color: white;
	    padding: 8px 32px;
	    text-align: center;
	    text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
	    margin: 4px 2px;
	    -webkit-transition-duration: 0.4s; /* Safari */
	    transition-duration: 0.4s;
	    cursor: pointer;
		}

		.button1 {
		    background-color: white; 
		    color: black; 
		    border: 2px solid #aaa;
		    border-radius: 4px;
		}

		.button1:hover {
		    background-color: dodgerBlue;
		    color: white;
		}

	</style>
</head>
<body style="background: url(hexa.gif);">
	<center>
		<form action="" method="post">
		<div class="inputWithIcon">
			<h1 style="color: powderblue; font-family: Lobster, cursive;">insert categories</h1>
			<input type="text" name="category" placeholder="Enter Category Name" value=""/>
			<i class="fas fa-shopping-bag" ></i>
		</div>
		<div class="inputWithIcon">
			<input type="submit" class="button1" name="submit" value ="submit"/>
		</div>
		</form><br><br><br><br><br><br><br><br><br><br>
	</center>
</body>
</html>
<?php
	
	if (isset($_POST['submit'])) 
	{
		include 'include/connection.php';
		$cat = $_POST['category'];

		$query = "INSERT INTO categories(cat_title) VALUES('$cat')";
		$data = mysqli_query($conn , $query);

		if ($data) 
		{
			echo "<script>alert('Category inserted successfully!')</script>";
			echo "<script>window.open('index.php?view_cat','_self')</script>";
		}
	}
	include 'edit_c.php';

?>