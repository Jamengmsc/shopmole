<?php
   include "../config/constants.php";

   if(isset($_GET['order_id']) && isset($_GET['prod_id'])){
      $order_id = $_GET['order_id'];
      $prod_id = $_GET['prod_id'];

      $sql = "UPDATE orders SET
         order_status = 'Cancelled',
         active = 0

         WHERE order_id=$order_id AND prod_id=$prod_id
      ";

      $res = mysqli_query($conn, $sql);

      if($res==true){
         header("location:" . SITEURL . "customer/order-details.php?order_id=" . $order_id);
      }
   }

   // Redirect to order-details.php and pass order_id to redirected page (DONE);