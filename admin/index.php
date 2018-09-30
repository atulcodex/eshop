<?php
    session_start();
    if (!$_SESSION['admin_email']) 
    {
      header('location:../index.php');
    }
    
    include 'include/connection.php';
    include 'include/1.function.php';
?>
<!DOCTYPE html>
<html>
<head>
      <!-- Google fonts -->
      <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Lobster" rel="stylesheet">
      <!-- fontawesome -->
      <link rel="stylesheet" type="text/css" href="font/css/all.min.css"/>
      <!-- StyleSheet-->
      <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body bgcolor="#b4b6ba">
<ul>
  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<abbr title="Founder of Justano"><img id="img" src="atul.jpg" width="150" height="150"></abbr> <abbr title="You want to update this Pic"><img id='pencil' name="edit_account" src="pencil.png" width="45" height="45"/></abbr></li>
  <li id="name">Atul K. Prajapati</li> 
  <li><a href="index.php?home"><i class="fas fa-home"></i> HOME</a></li>
  <li><a href="index.php?insert_items"><i class="fas fa-greater-than"></i> INSERT ITEMS</a></li>
  <li><a href="index.php?view_items"><i class="fas fa-mortar-pestle"></i> VIEW PRODUCTS</a></li>
  <li><a href="index.php?insert_cat"><i class="fas fa-greater-than"></i> INSERT CATEGORY</a></li>
  <li><a href="index.php?view_cat"><i class="fas fa-capsules"></i> VIEW CATEGORY</a></li>
  <li><a href="index.php?insert_brand"><i class="fas fa-greater-than"></i> INSERT BRANDS</a></li>
  <li><a href="index.php?view_brand"><i class="fas fa-code-branch"></i> VIEW BRANDS</a></li>
  <li><a href="index.php?view_customer"><i class="far fa-user"></i> VIEW CUSTOMERS</a></li>
  <li><a href="index.php?view_orders"><i class="far fa-folder-open"></i> VIEW ORDERS</a></li>
  <li><a href="index.php?view_payments"><i class="fas fa-rupee-sign"></i> VIEW PAYMENTS</a></li>
  <li><a href="logout.php"><i class="fas fa-power-off"></i> LOGOUT</a></li>
</ul>

<div style="margin-left:19.0%;padding:1px 16px;height:652px;">
    <?php
    if (isset($_GET['home']) || isset($_GET['index.php']))
    {
      echo "<img src='base1.png' width='70%' height='500'/>";
    }

    if (isset($_GET['insert_items'])) 
    {
        include 'insert.php';
    }

    if (isset($_GET['view_items'])) 
    {
        include 'view_products.php';
    }

    if (isset($_GET['eid'])) 
    {
        include 'edit_p.php';
    }

    if (isset($_GET['did'])) 
    {
        include 'delete.php';
    }

    if (isset($_GET['insert_cat'])) 
    {
        include 'insert_cat.php';
    }

    if (isset($_GET['view_cat'])) 
    {
        include 'view_cat.php';
    }

    if (isset($_GET['edit_cat'])) 
    {
        include 'insert_cat.php';
    }

    if (isset($_GET['delete_cat'])) 
    {
        include 'delete_c.php';
    }

    if (isset($_GET['insert_brand'])) 
    {
        include 'insert_bra.php';
    }

    if (isset($_GET['view_brand'])) 
    {
        include 'view_bra.php';
    }

    if (isset($_GET['edit_bra'])) 
    {
        include 'edit_b.php';
    }

    if (isset($_GET['delete_bra'])) 
    {
        include 'delete_b.php';
    }

    if (isset($_GET['view_customer'])) 
    {
       include 'view_customer.php';
    }

    if (isset($_GET['d_id'])) 
    {
       include 'delete_customer.php';
    }
    
    if (isset($_GET['view_orders'])) 
    {
       include 'view_order.php';
    }

    if (isset($_GET['delete_order'])) 
    {
       include 'delete_o.php';
    }

    if (isset($_GET['view_payments'])) 
    {
       include 'view_payment.php';
    }
?>
</div>

</body>
</html>
