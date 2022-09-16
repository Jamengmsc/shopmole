<?php
   $caption = "Order Success";
   include "../partials/header.php"; 
 ?>

<?php
   $sql = "SELECT * FROM cart WHERE user_id=$id";
   $res = mysqli_query($conn, $sql);
   $count = mysqli_num_rows($res);

   if($count>0){
      $order_id = rand(300000000, 400000000);
      $order_date = date("Y-m-d");
      $order_status = "Pending";
      
      $_SESSION['order-id'] = $order_id;

      while($rows = mysqli_fetch_assoc($res)){
         $prod_id = $rows['prod_id'];
         $item_qty = $rows['qty'];
         $item_price = $rows['price'];

         // Insert into orders database table
         $order = "INSERT INTO orders (order_id, user_id, prod_id, order_date, qty, price, order_status) VALUES ($order_id, $id, $prod_id, '$order_date', $item_qty, $item_price, '$order_status')";
         
         $order_res = mysqli_query($conn, $order);

         if($order_res==true){

            // SEND EMAIL TO CUSTOMER
            $subject = "Your ShopMole Order " . $order_id . " - item(s) have been placed";
            $body = "<h4>Your order " . $order_id . " has been successfully placed and awaiting confirmation.</h4> <br> <p>You can proceed to your orders and click on ORDER DETAILS to cancel or track your order</p>";
         
            // Get customer email to send message
            $cust_email = mysqli_query($conn, "SELECT email from customers where id=$id");
            $email = mysqli_fetch_assoc($cust_email)['email'];

            // Send HTML element tag in the mail
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->Send();

            // Insert Email sent to database
            $mess_id = rand(20000, 29999);

            $insert_email = "INSERT INTO emails (email_from, email_to, message_id, subj, message, user_id) VALUES ('".EMAIL."', '$email', $mess_id, '$subject', '$body', $id)";
            $insert_email_res = mysqli_query($conn, $insert_email);


            // DELETE ALL CART ITEMS FOR CUSTOMER WITH THE CURRENT ORDER ID
            $del_cart = "DELETE FROM cart WHERE user_id=$id";
            $del_cart_res = mysqli_query($conn, $del_cart);



            // SEND MESSAGE TO CUSTOMER'S INBOX
            $message = "Your order $order_id has been sent and awaits confirmation. On confirmation, your delivery will take approximately 7 working days, expected to be between " . Date('d-M-Y', strtotime('+7 day')) . " and " . Date('d-M-Y', strtotime('+8 day')) . " .Thank you for shopping on MyShop, your one-stop shop deal";

            $mess_date = date("Y-m-d");

            // Send a order sent message to customer inbox
            $cust_inbox = "INSERT INTO cust_inbox (mess, message_date, order_id, order_status, user_id) VALUES ('$message', '$mess_date', $order_id, '$order_status', $id)";

            $cust_inbox_res = mysqli_query($conn, $cust_inbox);

            // redirect to order-success.php page
            echo "<script>location.href='order-success.php'></script>";
         }
      }
   }
?>

<section id="order_success">
   <div class="order_success">
      <div class="order_summary">
         <div class="order_details">
            <div class="order_confirm">
               <div class="order_check"><i class="fas fa-check"></i></div>

               <div class="order_note">
                  <div class="order_congrats">Thank you for placing an order on MyShop</div>
                  <div class="order_num">Order No. <span><?= $order_id; ?></span></div>
               </div>
            </div>

            <a href="<?php echo SITEURL ?>customer/order-details.php?order_id=<?php echo $_SESSION['order-id'] ?>">SEE ORDER DETAILS</a>
         </div>
      </div>

      <div class="order_delivery">
         <div class="door_delivery">
            <i class="fas fa-truck"></i>

            <div class="detail">
               <h3>Door Delivery</h3>
               <p class="delivery_note">Delivery Between <span><?php echo Date('d-M-Y', strtotime('+7 day')) ?></span> and <span><?php echo Date('d-M-Y', strtotime('+8 day')) ?></span></p>
            </div>
         </div>

         <div class="cash_delivery">
            <i class="fas fa-hand-holding-usd"></i>

            <div class="detail">
               <h3>Cash on Delivery</h3>
               <p class="delivery_note">Ready your cash, preferably the exact amount, to ease the transaction.</p>
            </div>
         </div>
      </div>
   </div>
</section>


<?php include "../partials/footer.php"; ?>