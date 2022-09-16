<?php
   $caption = "Order Details";
   include "../partials/header.php";
   include "../config/auth.php";
?>


<!-- edit account starts -->
<section class="user-account order-details" id="order-details">
   <div class="wrapper">
      <?php include "../partials/sidemenu.php"; //Sidemenu for customers' page ?>

      <div class="main">
         <h5><a href="#" onclick="history.go(-1)"><i class="fas fa-arrow-left"></i></a> Order Details</h5>

      <?php
         if(isset($_GET['order_id'])){
            $order_id = $_GET['order_id'];
         }

         $sql = "SELECT * FROM orders WHERE order_id=$order_id";
         $res = mysqli_query($conn, $sql);
         $count = mysqli_num_rows($res);
         $rows = mysqli_fetch_assoc($res);
      ?>
         
         <div class="order_record">
            <div class="order-date">
               <div class="order_no">Order No: <?php echo $order_id ?></div>
               <div class="order_date">Date: <span>
                  <?php
                     $date = strtotime($rows['order_date']);
                     echo $date = date('M d, Y', $date);
                  ?>
                  </span>
               </div>
            </div>

            <div class="item_qty"><?php echo $count ?> Item(s)</div>
            <div class="order_total">Total: &#8358; <span>
               <?php
                  $total = "SELECT SUM(qty*price) AS total FROM orders WHERE order_id=$order_id";
                  $total_res = mysqli_query($conn, $total);
                     $total_row = mysqli_fetch_assoc($total_res);
                     echo $total_row['total'];
               ?>
            </span></div>
         </div>

         <hr style="margin-top:0">

         <div class="item_ordered_head">ITEMS IN YOUR ORDER</div>

      <?php
         $get_id = "SELECT prod_id, qty, order_status FROM orders WHERE order_id=$order_id";
         $get_id_res = mysqli_query($conn, $get_id);
         $count_id = mysqli_num_rows($get_id_res);

         if($count_id>0){
            while($id_row = mysqli_fetch_assoc($get_id_res)){
               $Prod_id = $id_row['prod_id'];

               $get_prod = "SELECT * FROM products WHERE prod_id=$Prod_id";
               $get_prod_res = mysqli_query($conn, $get_prod);
               $count_prod = mysqli_num_rows($get_prod_res);

               if($count_prod==1){
                  $prod_row = mysqli_fetch_assoc($get_prod_res);
               ?>
                  <!-- Order Item -->
                  <div class="ordered_item">
                     <div class="item_details">
                        <span class="order_status"> 
                           <?php
                              echo $id_row['order_status'];
                           ?>
                           </span>
                           <div class="date_to_deliver">
                              Delivered between
                              <?php
                                 $ord_date = $rows['order_date'];
                                 $date = strtotime($ord_date);
                                 $date = strtotime("+7 day", $date);

                                 $date2 = strtotime($ord_date);
                                 $date2 = strtotime("+8 day", $date2);
                                 echo " <span class='text-info'>" . date("F d, Y", $date) . "</span> and <span class='text-info'>" . date("F d, Y", $date2) . "</span> from the order date";
                              ?>
                           </div>

                           <div class="item">
                              <div class="item_img">
                                 <?php
                                    if($prod_row['image_name'] !=""){
                                 ?>
                                    <img src="../images/products/<?= $prod_row['image_name'] ?>">
                                 <?php
                                    }
                                 ?>
                              </div>

                           <div class="item_desc">
                              <div class="item_name"><?php echo $prod_row['prod_name'] . " - " . $prod_row['spec'] ?></div>
                              <div class="item_qty">QTY: <span><?php echo $id_row['qty'] ?></span></div>
                              <h3 class="item_amount">&#8358; <span>
                                 <?php
                                    $net_price = ((100-$prod_row['discount']) * $prod_row['price'])/100;
                                    echo $net_price;
                                 ?>
                              </span> &nbsp;<span>&#8358; <?php echo $prod_row['price'] ?></span></h3>
                           </div>
                        </div>
                     </div>

                     <div class="order_action">
                        <?php
                           if($id_row['order_status'] == "Delivered"){
                              echo "<div style='font-size:14px; font-weight:700; color:green; background:#eee; padding: 3px 10px; border-radius: 3px'>CLOSED</div>";
                           }
                           elseif($id_row['order_status'] == "Shipped"){
                           ?>
                              <a href="#" class="track_item">TRACK ITEM</a>
                           <?php
                              }
                              else{
                           ?>
                              <a href="<?php echo SITEURL ?>customer/cancel-item.php?order_id=<?php echo $order_id ?>&prod_id=<?php echo $Prod_id ?>" class="cancel_item">CANCEL ITEM</a>

                              <a href="#" class="track_item">TRACK ITEM</a>
                           <?php
                           }
                        ?>
                     </div>
                  </div>
               <?php
               }
            }
         }
      ?>

      <div class="order_info">
         <div class="payment_info">
            <div class="header">PAYMENT INFORMATION</div>

            <div class="payment_method">
               <h6>Payment Method</h6>
               <p>Cash On Delivery</p>
            </div>

            <div class="payment_details">
               <h6>Payment Details</h6>
               <div class="item_total"><span>Items Totals:</span> &#8358; <span><?php echo $total_row['total'] ?></span></div>
               <div class="shipping_fee"><span>Shipping Fee:</span> &#8358; <span><?php echo $shipping_fee = 1500 ?></span></div>
               <div class="total"><span>Total:</span> &#8358; <span><?php echo $total_row['total'] + $shipping_fee; ?></span></div>
            </div>
         </div>

         <div class="delivery_info">
            <div class="header">PAYMENT INFORMATION</div>

            <div class="delivery_method">
               <h6>Delivery Method</h6>
               <p>Standard Door Delivery</p>
            </div>

            <?php
               $cust_det = "SELECT * FROM customers where id=$id";
               $cust_det_res = mysqli_query($conn, $cust_det);
               $count_cust = mysqli_num_rows($cust_det_res);
               
               if($count_cust==1){
                  $cust_row = mysqli_fetch_assoc($cust_det_res);
               }
            ?>

            <div class="shipping_address">
               <h6>Shipping Address</h6>
               
               <div class="cust_name"><?php echo $cust_row['firstname'] . " " . $cust_row['lastname'] ?></div>
               <div class="cust_address"><?php echo $cust_row['address'] ?></div>
               <div class="cust_address_add"><?php echo $cust_row['address_add'] ?></div>
               <div class="cust_country"><?php echo $cust_row['country'] ?></div>
               <div class="cust_state"><?php echo $cust_row['state'] ?></div>
            </div>
         </div>
      </div>

      <a href="#" class="need_help">Need Help?</a>
   </div>

   </div>
</section>


<?php include "../partials/footer.php"; ?>