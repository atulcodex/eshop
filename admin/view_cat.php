<?php
	session_start();
    include'include/connection.php';  

    if (!$_SESSION['admin_email']) 
    {
      header('location:../index.php');
    }
?>
<style type="text/css">
	table
	{
		background: url(hexa.gif);
		border: 1px solid powderblue;
		border-radius: 4px;
		border-color: powderblue;
		color: powderblue;
		font-family: 'Do Hyeon', sans-serif;
	}
	th,td
	{

		border: 1px solid powderblue;
		border-radius: 4px;
		border-color: powderblue;
	}
	td a:link
	{
		text-decoration: none;
		color: powderblue;
	}
</style>
<table width="800" style="">
	<tr>
		<th>ID</th>
		<th>CATEGORY</th>
		<th colspan="2">FEATURE</th>
	</tr>
<?php
	include 'include/connection.php';

	$query = "SELECT * FROM categories";
	$data = mysqli_query($conn , $query);
	
	while ($result = mysqli_fetch_assoc($data)) 
	{
		$id = $result['cat_id'];
		$title = $result['cat_title'];
	
?>
<tr align="center">
	<td><?php echo $id; ?></td>
	<td><?php echo $title; ?></td>
	<td><a href="index.php?edit_cat=<?php echo $id; ?>"><i class="fas fa-pen-alt"></i></a></td>
	<td><a href="index.php?delete_cat=<?php echo $id; ?>"><i class="fas fa-trash-alt"></i></a></td>
</tr>
<?php } ?>
</table>