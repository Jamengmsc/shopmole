<!-- General order status update -->
<?php

   include "email-const.php"; //Constants for sending email to customer

   $upd_status_res = mysqli_query($conn, "SELECT * FROM orders WHERE active=1 GROUP BY order_id");
   $count_orders = mysqli_num_rows($upd_status_res);
   
   if($count_orders>0){
      while($order_rows = mysqli_fetch_assoc($upd_status_res)){
         $order_id = $order_rows['order_id'];
         $user_id = $order_rows['user_id'];
         $order_date = $order_rows['order_date'];
         $order_status = $order_rows['order_status'];

         $date = strtotime($order_date); //Order date to string

         // Order date (formatted)
         $date = date("M d, Y", $date);

         // Delivery date
         $del_date = strtotime($date);
         $del_date = strtotime("+7 day", $del_date);
         $del_date = date("M d, Y", $del_date);

         // Shipped date
         $ship_date = strtotime($date);
         $ship_date = strtotime("+4 day", $ship_date);
         $ship_date = date("M d, Y", $ship_date);

         // Current Date
         $now_date = date("M d, Y");

         // CHECK FOR ORDERS WITH SHIPPED DATE REACHED
         if($now_date >= $ship_date){
            $upd_order_res = mysqli_query($conn, "SELECT * from orders where not order_status='Shipped' and order_id=$order_id and active=1 group by order_id");
            $count_ord = mysqli_num_rows($upd_order_res);
            
            if($count_ord==1){
               $order_status = "Shipped";

               $update_ord = "UPDATE orders set order_status='$order_status' where order_id=$order_id and active=1";
               $update_ord_res = mysqli_query($conn, $update_ord);
               
               // Get customer email to send mail to
               $get_email = mysqli_query($conn, "SELECT email from customers where id=$user_id");
               $email = mysqli_fetch_assoc($get_email)['email'];

               // SEND EMAIL TO CUSTOMER
               $subject = "[" . $order_status ." Order] Your ShopMole Order with ID: " . $order_id;
               $body = "Your order with ID: " . $order_id . " has left our store for shipping to your delivery address. You would be called by one of our agents for delivery once is the item(s) reaches your address. <br> Kindly, keep all possibly reachable contacts ON so you can be reached. <br><br> Thank you for shopping on ShopMole";
               
               // Send HTML element tag in the mail
               $mail->addAddress($email);
               $mail->Subject = $subject;
               $mail->Body = $body;
               $mail->Send();

               // Insert Email sent to database
               $mess_id = rand(20000, 29999);

               $insert_email = "INSERT INTO emails (email_from, email_to, message_id, subj, message, user_id) VALUES ('".EMAIL."', '$email', $mess_id, '$subject', '$body', $user_id)";
               $insert_email_res = mysqli_query($conn, $insert_email);
            }
         }

         // CHECK FOR ORDERS READY TO BE DELIVERED
         if($now_date >= $del_date){
            $upd_order = "SELECT * from orders where not order_status='Delivered' and order_id=$order_id and active=1 group by order_id";
            $upd_order_res = mysqli_query($conn, $upd_order);
            $count_ord = mysqli_num_rows($upd_order_res);
            
            if($count_ord==1){
               $val = mysqli_fetch_assoc($upd_order_res);
               $user = $val['user_id'];
               $del_status = "Delivered";
               
               $update_ord = "UPDATE orders set order_status='$del_status', active=0 where order_id=$order_id and active=1";
               $update_ord_res = mysqli_query($conn, $update_ord);
               
               // Get customer email to send mail to
               $get_email = mysqli_query($conn, "SELECT email from customers where id=$user");
               $email = mysqli_fetch_assoc($get_email)['email'];

               // SEND EMAIL TO CUSTOMER
               $subject = "[" . $del_status ." Order] Your ShopMole Order with ID: " . $order_id;
               $body = "Your order with ID: " . $order_id . " has been successfully delivered to you and confirmed paid for. <br><br> Kindly inspect and confirm the state of the item(s), and if there is any issue that would warant unacceptance, please apply for item(s) return WITHIN 7 days of delivery (Carefully read our Return Policy to guide you on this process and adequately). <br><br> Thank you for shopping on ShopMole";
               
               // Send HTML element tag in the mail
               $mail->addAddress($email);
               $mail->Subject = $subject;
               $mail->Body = $body;
               $mail->Send();

               // Insert Email sent to database
               $mess_id = rand(20000, 29999);

               $insert_email = "INSERT INTO emails (email_from, email_to, message_id, subj, message, user_id) VALUES ('".EMAIL."', '$email', $mess_id, '$subject', '$body', $user_id)";
               $insert_email_res = mysqli_query($conn, $insert_email);
            }
         }
      }
   }

?>