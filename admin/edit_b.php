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

		.inputicon input[type=text]
		{
			padding-left: 40px;
		}

		.inputicon
		{
			position: relative;
		}

		.inputicon i
		{
			position: absolute;
			left: 410px;
			top: 8px;
			padding: 28px 8px;
			color: #aaa;
		}

		.inputicon input[type=text]:focus + i
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
	<?php
		  include 'include/connection.php';
		  if(isset($_GET['edit_bra']))
		  {
		    $bra_id = $_GET['edit_bra'];

		    $query1 = "SELECT * FROM brands WHERE brand_id='$bra_id'";
		    $data1 = mysqli_query($conn, $query1);
		    $result1 = mysqli_fetch_assoc($data1);

		    $tt = $result1['brand_title'];
		    $ti = $result1['brand_id'];
		  }
	?>
	<center>
		<form action="" method="post">
		<div class="inputicon">
			<h1 style="color: powderblue; font-family: Lobster, cursive;">update brands</h1>
			<input type="text" name="brand" value="<?php echo $tt; ?>"/>
			<i class="fas fa-shopping-bag" ></i>
		</div>
		<div class="inputicon">
			<input type="submit" class="button1" name="submit" value ="submit"/>
		</div>
		</form>
	</center>
</body>
</html>
<?php
	if (isset($_POST['submit'])) 
	{
		$bran = $_POST['brand'];

		$query1 = "UPDATE brands SET brand_title='$bran' WHERE brand_id='$ti'";
		$data1 = mysqli_query($conn, $query1);

		if ($data1) 
		{
			echo "<script>alert('brand updated successfully!')</script>";
			echo "<script>window.open('index.php?view_brand','_self')</script>";
		}
		else
		{
			echo "<script>alert('Brand Not updated successfully!')</script>";
		}
	}
?>

