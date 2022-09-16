<?php include "../config/constants.php"; ?>

<?php
if(isset($_GET['order_id']) && isset($_GET['user_id'])){
   $id = $_GET['user_id'];
   $order_id = $_GET['order_id'];
   $order_status = "Confirmed";

   $sql = "SELECT prod_id, qty FROM orders WHERE order_id=$order_id";
   $res = mysqli_query($conn, $sql);
   $count = mysqli_num_rows($res);

   if($count>0){
      while($rows = mysqli_fetch_assoc($res)){
         $prod_id = $rows['prod_id'];
         $order_qty = $rows['qty']; //Ordered quantity

         $query_prod = "SELECT qty, prod_name FROM products WHERE prod_id=$prod_id";
         $query_prod_res = mysqli_query($conn, $query_prod);
         $count_prod = mysqli_num_rows($query_prod_res);

         if($count_prod==1){
            $prod_row = mysqli_fetch_assoc($query_prod_res);
            $prod_qty = $prod_row['qty'];         //Product Availablel quantity
            $avail_qty = $prod_qty - $order_qty;  //Available product quantity after order has been confirmed

            // Prevent the error of ordering more quantities than availlable
            if($avail_qty < 0){
               $_SESSION['status-updated'] = "<div class='mt-3'>Insufficient Inventory Quantity To Order for <span class='text-danger font-weight-bold'>" . $prod_row['prod_name'] . "</span></div>";
               header("location:" . SITEURL . 'admin/pending-order.php');
               die();
            }
            
            // Update products quantity after order is confirmed
            $upd_prod_qty = "UPDATE products SET
               qty = $avail_qty
             WHERE prod_id=$prod_id";

            $upd_prod_qty_res = mysqli_query($conn, $upd_prod_qty); //Execute the update product query

            // Check if product quantity is unable to be updated
            if($upd_prod_qty_res==false){
               $_SESSION['status-updated'] = "<div class='mt-3'> Could Not Update Product Quantity for <span class='text-danger font-weight-bold'>" . $prod_row['prod_name'] . "</span></div>";
               header("location:" . SITEURL . 'admin/pending-order.php');
               die();
            }
         }
      }

      // Update the Order status to confirmed order
      $upd_ord_status = "UPDATE orders SET
         order_status = '$order_status',
         active = 1
         WHERE order_id=$order_id
      ";
      $upd_ord_status_res = mysqli_query($conn, $upd_ord_status);
   
      // confirm that order status is successfully updated
      if($upd_ord_status_res==true){
         $_SESSION['status-updated'] = "Customer Order with ID: " . $order_id . " is Confirmed";

         // SEND EMAIL TO CUSTOMER
         $subject = "Your ShopMole Order " . $order_id . " - item(s) have been confirmed";
         $body = "<h4>Your order has been successfully confirmed and ready to be shipped for delivery.</h4> <br> <p>You can proceed to your orders and click on 'Order Details' to cancel or track your order</p>";
      
         // Get customer email to send message
         $cust_email = mysqli_query($conn, "SELECT email from customers where id=$id");
         $email = mysqli_fetch_assoc($cust_email)['email'];
      
         include "../mail/index.php";

         // Insert Email sent to database
         $mess_id = rand(20000, 29999);

         $insert_email = "INSERT INTO emails (email_from, email_to, message_id, subj, message, user_id) VALUES ('".EMAIL."', '$email', $mess_id, '$subject', '$body', $id)";
         $insert_email_res = mysqli_query($conn, $insert_email);

         header("location:" . SITEURL . 'admin/pending-order.php');
      }
      else{
         $_SESSION['status-updated'] = "Could Not Confirm Customer Order with ID: " . $order_id;
         header("location:" . SITEURL . 'admin/pending-order.php');
      }

      // Update Message to send to user in inbox
      $upd_inbox = "UPDATE cust_inbox SET
         order_status = '$order_status',
         active = 1

         WHERE order_id = $order_id
      ";
      $upd_inbox_res = mysqli_query($conn, $upd_inbox);

   }
}

?>