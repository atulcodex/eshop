<?php
    session_start();
    include 'functions/1.function.php';
    if (!$_SESSION['customer_email']) 
        {
          header('location:customer_login.php');
        }
?>
<!DOCTYPE html>
<html>
<head>
      <!-- Google fonts -->
      <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Lobster" rel="stylesheet">
      <!-- fontawesome -->
      <link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
<style>
body {
    margin: 0;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 20%;
    font-family: 'Do Hyeon', sans-serif;
    background-color: #636262;
    position: fixed;
    height: 100%;
    overflow: auto;
}

li #img
{
  border: 5px;
  border-radius: 80px;
  padding-top: 5px;
}

#name
{
  margin-left: 100px;
}

li a {
    display: block;
    color: #000;
    font-family: 'Do Hyeon', sans-serif;
    padding: 8px 60px;
    text-decoration: none;
}

li a.active {
    background-color: #4081e8;
    color: white;
}

li a:hover:not(.active) {
    background-color: #4081e8;
    color: white;
}
</style>
</head>
<body>
<?php
        $conn = mysqli_connect("localhost","root","","eshop");


        $email = $_SESSION['customer_email'];
        $query = "SELECT * FROM customers WHERE c_email='$email'";
        $data = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($data);

        $na = $result['c_name'];
        $em = $result['c_email'];
        $co = $result['c_country'];
        $ci = $result['c_city'];
        $mo = $result['c_contact'];
        $add = $result['c_address'];
        $img = $result['c_img'];

?>
<ul>
  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="img" src="<?php echo $img; ?>" width="150" height="150"> <abbr title="You want to update this Pic"><img id='pencil' name="edit_account" src="img/pencil.png" width="45" height="45"/></abbr></li>
  <li id="name"><?php echo $na; ?>
  <li><a href="1.myaccount.php">HOME</a></li>
  <li><a href="1.myaccount.php?my_order"> MY ORDERS</a></li>
  <li><a href="index.php">START SHOPPING</a></li>
  <li><a href="1.myaccount.php?edit_account">EDIT ACCOUNT</a></li>
  <li><a href="1.myaccount.php?change_pass">CHANGE PASSWORD</a></li>
  <li><a href="1.myaccount.php?delete_account">DELETE ACCOUNT</a></li>
  <li><a href="logout.php">LOGOUT</a></li>
</ul>

<div style="margin-left:25%;padding:1px 16px;height:650px;">
    <?php 
        getDefault(); 
    ?>
    <?php
        if (isset($_GET['my_order'])) 
        {
            include '2.my_order.php';  
        }
        if (isset($_GET['edit_account'])) 
        {
            include '4.edit_account.php';
        }
        if (isset($_GET['change_pass'])) 
        {
            include '5.change_pass.php';
        }
        if (isset($_GET['delete_account'])) 
        {
            include '6.delete_account.php';
        }
    ?>
  </div>
</div>

</body>
</html>
