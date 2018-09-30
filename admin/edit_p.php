<?php
	include 'include/connection.php';
	if (isset($_GET['eid'])) 
	{
		$id = $_GET['eid'];

		$query = "SELECT * FROM products WHERE product_id='$id'";		//getting products details
		$data = mysqli_query($conn , $query);
		$result = mysqli_fetch_assoc($data);

		$up_id = $result['product_id'];
		$pname = $result['product_title'];
		$pcat = $result['product_cat'];
		$pbra = $result['product_brand'];
		$pimg1 = $result['product_img1'];
		$pimg2 = $result['product_img2'];
		$pimg3 = $result['product_img3'];
		$ppri = $result['product_price'];
		$pdis = $result['product_desc'];
		$pkey = $result['keyword'];
	}
	$query1 = "SELECT * FROM categories WHERE cat_id='$id'";		//getting category title
	$data1 = mysqli_query($conn , $query1);
	$result1 = mysqli_fetch_assoc($data1);				
	$title1 = $result1['cat_title'];


	$query2 = "SELECT * FROM brands WHERE brand_id='$id'";		//getting brand title
	$data2 = mysqli_query($conn , $query2);
	$result2 = mysqli_fetch_assoc($data2);					
	$title2 = $result2['brand_title'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>UPDATE RECORDS</title>
	 <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  	 <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="#d4d6d8">
	<center>
	<form action="" method="post" enctype="multipart/form-data" >
		<table border="1" width="90.50%" bgcolor="#4081e8">
			<tr>
				<th colspan="2" align="center" bgcolor="orange">Update Data Or Products</th>
			</tr>
			<tr>
				<td align="right">Product Name : </td>
				<td><input type="text" name="product_title" size="50" value="<?php echo $pname; ?>"/> </td>
			</tr> 
			<tr>
				<td align="right">Product Category : </td>
				<td>
					<select name="product_cat" >
						<option value="<?php echo $cid; ?>"><?php echo $title1; ?></option>							
							<?php
								$query = "SELECT * FROM categories";
								$data = mysqli_query($conn , $query);

								while ($result = mysqli_fetch_assoc($data)) 
								{
									$cid = $result['cat_id'];
									$title = $result['cat_title'];

									echo"<option value='$cid'>$title</option>";
								}
							?>
						
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">Product Brand : </td>
				<td>
					<select name="product_brand" >
						<option value="<?php echo $bid; ?>"><?php echo $title2; ?></option>							
							<?php
								$query = "SELECT * FROM brands";
								$data = mysqli_query($conn , $query);

								while ($result = mysqli_fetch_assoc($data)) 
								{
									$bid = $result['brand_id'];
									$title = $result['brand_title'];

									echo"<option value='$bid'>$title</option>";
								}
							?>
						
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">Product image 1 : </td>
				<td><input type="file" name="product_img1"  value=""/> <br><img src="<?php echo $pimg1; ?>" width="50" height="50"></td>
			</tr>
			<tr>
				<td align="right">Product image 2 : </td>
				<td><input type="file" name="product_img2"  value=""/> <br><img src="<?php echo $pimg2; ?>" width="50" height="50"></td>
			</tr>
			<tr>
				<td align="right">Product image 3 : </td>
				<td><input type="file" name="product_img3"  value=""/> <br><img src="<?php echo $pimg3; ?>" width="50" height="50"></td>
			</tr>
			<tr>
				<td align="right">Product Price : </td>
				<td><input type="text" name="product_price"  value="<?php echo $ppri; ?>"/> </td>
			</tr>

			<tr>
				<td align="right">Product Description : </td>
				<td><textarea name="product_desc"  cols="48" rows="7"><?php echo $pdis; ?></textarea></td>
			</tr>
			<tr>
				<td align="right">Product Keyword : </td>
				<td><textarea name="product_keyword"  cols="32" rows="4"><?php echo $pkey; ?></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center" bgcolor="orange"><input type="submit" name="submit" value="UPDATE NOW"/> </td>
			</tr>
		</table>
	</form></center>
</body>
</html>
<?php
	if (isset($_POST['submit'])) 
	{
		
		$title = $_POST['product_title'];
		$category = $_POST['product_cat'];
		$brand = $_POST['product_brand'];
		$price = $_POST['product_price'];
		$desc = $_POST['product_desc'];
		$keyword = $_POST['product_keyword'];

		$image1 = $_FILES["product_img1"]["name"];
		$temp_image1 = $_FILES["product_img1"]["tmp_name"];
		$folder1 ="img/".$image1;

		$image2 = $_FILES["product_img2"]["name"];
		$temp_image2 = $_FILES["product_img2"]["tmp_name"];
		$folder2 ="img/".$image2;

		$image3 = $_FILES["product_img3"]["name"];
		$temp_image3 = $_FILES["product_img3"]["tmp_name"];
		$folder3 ="img/".$image3;
		

		if ($title=='' OR $category=='' OR $brand=='' OR $price=='' OR $desc=='' OR $keyword=='' OR $folder1=='') 
		{
			echo "<script>alert('all fields are required')</script>";
		}
		elseif($title!='' OR $category!='' OR $brand!='' OR $price!='' OR $desc!='' OR $keyword!='' OR $folder1!='')
		{
			move_uploaded_file($temp_image1,$folder1);
			move_uploaded_file($temp_image2,$folder2);
			move_uploaded_file($temp_image3,$folder3);

			$query3 = "UPDATE products SET product_title='$title', cat_id='$category', date=NOW() , brand_id ='$brand', product_img1='$folder1', product_img2='$folder2', product_img3='$folder3', product_price='$price', product_desc='$desc', keyword='$keyword' WHERE product_id='$up_id'";

			$data3 = mysqli_query($conn , $query3);

			if ($data3) 
			{
				echo "<script>alert('Data updated successfully')</script>";
				echo "<script>window.open('index.php?view_items','_self')</script>";
			}
		}
		else
		{
			echo "<script>alert('Data not updated successfully')</script>";
		}
		
	}
?>