<?php
session_start();
    include'include/connection.php';  

    if (!$_SESSION['admin_email']) 
    {
      header('location:../index.php');
    }
	include 'include/connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>insert data</title>
	 <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  	 <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="#d4d6d8">
	<center>
	<form action="insert.php" method="post" enctype="multipart/form-data" >
		<table border="1" width="90.50%" bgcolor="#4081e8">
			<tr>
				<th colspan="2" align="center" bgcolor="orange">Insert Data Or Products</th>
			</tr>
			<tr>
				<td align="right">Product Name : </td>
				<td><input type="text" name="product_title" size="50" value=""/> </td>
			</tr> 
			<tr>
				<td align="right">Product Category : </td>
				<td>
					<select name="product_cat" >
						<option>
							select category
							<?php
								$query = "SELECT * FROM categories";
								$data = mysqli_query($conn , $query);

								while ($result = mysqli_fetch_assoc($data)) 
								{
									$id = $result['cat_id'];
									$title = $result['cat_title'];

									echo"<option value='$id'>$title</option>";
								}
							?>
						</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">Product Brand : </td>
				<td>
					<select name="product_brand" >
						<option>
							select brands
							<?php
								$query = "SELECT * FROM brands";
								$data = mysqli_query($conn , $query);

								while ($result = mysqli_fetch_assoc($data)) 
								{
									$id = $result['brand_id'];
									$title = $result['brand_title'];

									echo"<option value='$id'>$title</option>";
								}
							?>
						</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">Product image 1 : </td>
				<td><input type="file" name="product_img1"  value=""/> </td>
			</tr>
			<tr>
				<td align="right">Product image 2 : </td>
				<td><input type="file" name="product_img2"  value=""/> </td>
			</tr>
			<tr>
				<td align="right">Product image 3 : </td>
				<td><input type="file" name="product_img3"  value=""/> </td>
			</tr>
			<tr>
				<td align="right">Product Price : </td>
				<td><input type="text" name="product_price"  value=""/> </td>
			</tr>

			<tr>
				<td align="right">Product Description : </td>
				<td><textarea name="product_desc"  cols="48" rows="7"></textarea></td>
			</tr>
			<tr>
				<td align="right">Product Keyword : </td>
				<td><textarea name="product_keyword"  cols="32" rows="4"></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center" bgcolor="orange"><input type="submit" name="submit" value="insert"/> </td>
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
		$status = 'on';

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
			exit();
		}
		elseif($title!='' OR $category!='' OR $brand!='' OR $price!='' OR $desc!='' OR $keyword!='' OR $folder1!='')
		{
			move_uploaded_file($temp_image1,$folder1);
			move_uploaded_file($temp_image2,$folder2);
			move_uploaded_file($temp_image3,$folder3);

			$query = "INSERT INTO products(cat_id, brand_id, date, product_title, product_img1, product_img2, product_img3, product_price, product_desc, keyword, status) VALUES('$category', '$brand', NOW(), '$title', '$folder1', '$folder2', '$folder3', '$price', '$desc', '$keyword', '$status')";

			$data = mysqli_query($conn , $query);

			if ($data) 
			{
				echo "<script>alert('Data inserted successfully')</script>";
				echo "<script>window.open('index.php?insert_items','_self')</script>";
			}
		}
		else
		{
			echo "Data not inserted successfully";
		}

	}
?>