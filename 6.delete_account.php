<?php
    session_start();
    if (isset($_GET['delete_account'])) 
    {
        $email = $_SESSION['customer_email'];
    }
?>
<!DOCTYPE html>
<html>
<head>
<style>
.button {
    background-color: #4081e8; /* Green */
    border: none;
    color: white;
    padding: 10px 52px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}

.button {
    background-color: white; 
    color: black; 
    border: 2px solid #4081e8;
}

.button:hover {
    background-color: #4081e8;
    color: white;
}


</style>
</head>
<body>
    <form action="" method="post">
        
        
        <table>
            <tr>
                <th><h2 style="color: #4081e8; font-family: Lobster, cursive;">choose any one option</h2></th>
            </tr>
            <tr>
                <td>
                    <button class="button" type="submit" name="yes">YOU WANT TO DELETE!</button>
                    <button class="button" type="submit" name="no">YOU DON'T WANT TO DELETE!</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
   $em = $email;

   if (isset($_POST['yes'])) 
   {
       $query = "DELETE FROM customers WHERE c_email='$em'";
       $data = mysqli_query($conn , $query);

       if ($data) 
       {
           echo "<script>alert('your account is deleted')</script>";
           echo "<script>window.open('logout.php','_self')</script>";
       }
       else
       {
            echo "<script>alert('your account is not deleted')</script>";
       }
   }

   if (isset($_POST['no'])) 
   {
       
           echo "<script>window.open('1.myaccount.php','_self')</script>";
      
   }
?>
