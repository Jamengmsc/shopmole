<?php
   include "../config/constants.php";

   if(isset($_GET['user_id'])){
      $user_id = $_GET['user_id'];

      $query = "UPDATE cust_inbox SET
         active = 1

         WHERE user_id=$user_id
      ";
      $result = mysqli_query($conn, $query);

      header("location:" . SITEURL . "customer/inbox.php");
   }
?>