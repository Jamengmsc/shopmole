<?php
   $caption = "Checkout";
   include "../partials/header.php";
   include "../config/auth.php";
   $shipping_fee = 1500;

   // Check if there is cart item(s) for customer
   $check_cart = "SELECT user_id FROM cart WHERE user_id=$id";
   $check_cart_res = mysqli_query($conn, $check_cart);
      if(mysqli_num_rows($check_cart_res) == 0){
         echo "<script>location.href='cart.php'</script>";
      }

   // Cart Total
   $cart_total = "SELECT SUM(price*qty) as total FROM cart WHERE user_id=$id";
   $cart_res = mysqli_query($conn, $cart_total);
   $cart_row = mysqli_fetch_assoc($cart_res);

?>

<section class="checkout-wrapper" id="checkout">
   <div class="checkout">
      <h4>checkout</h4>

      <div class="checkout-content">
         <div class="address-details">
            <div class="addr-head">
               <span>
                  <i class="fas fa-check-circle"></i>
                  <h3>1. address details</h3>
               </span>

               <a href="<?php echo SITEURL ?>/customer/edit-address.php">change</a>
            </div>
         
            <?php
               $sql = "SELECT * FROM customers WHERE id=$id";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);

               if($count==1){
                  $row = mysqli_fetch_assoc($res);
               }
            ?>

            <div class="address">
               <h3><?= $row['firstname'] . " " . $row['lastname'] ?></h3>
               <p><?= $row['address'] . " " . $row['address_add'] ?></p>
               <p><?= $row['mobile']?></p>
            </div>
         </div>
         
         <div class="delivery-method">
            <div class="method-head">
               <i class="fas fa-check-circle"></i>
               <h3>2. delivery method</h3>
            </div>

            <div class="del-method-content">
               <p>How do you want your order delivered?</p>

               <div class="door-del">
                  <i class="far fa-dot-circle"></i>
                  
                  <div class="door-deli-cont">
                     <h5>Door Delivery</h5>

                     <div class="delivered">Delivered by <span>
                        <?php
                           $date = Date("l j M", strtotime("+7 day"));
                           echo $date;
                        ?>
                     </span> for <span>&#8358; <?php echo $shipping_fee ?></span></div>
                     <div class="door-del-note">
                        <div class="door-del-note-items">
                           <i class="fas fa-exclamation-circle"></i>

                           <ul>
                              <li> - Large items (e.g. Freezers) may arrive 2 business days later than other products</li>
                              <li> - Living in Lagos, Abuja or Ibadan, <a href="#">SHOPPING PRIME</a> Members enjoy Free Delivery on All Local orders (excluding bulky items) and Jumia Food Orders.</li>
                              <li> -  Receive free delivery on your Jumia Express orders above N12,000 in Lagos</li>
                              <li> - Ensure your address is current as Delivery Agents would only deliver to the stated address.</li>
                              <li> - Package may arrive before the delivery date. Payment must be made before collection as Delivery agents are not allowed to open a package</li>
                              <li> - On delivery day, delivery time may vary due to possible eventualities.</li>
                              <li> - For more information on returns please <a href="#">right click here!</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>

               <hr style="margin: 10px -25px 20px 0">

               <div class="door-del">
                  <i class="far fa-circle"></i>
                  
                  <div class="door-deli-cont">
                     <h5>Pickup Station (Cheaper Shipping Fees than Door Delivery)</h5>

                     <div class="delivered">Available for pick up from <span>
                        <?php
                           $date = Date("l j M", strtotime("+7 day"));
                           echo $date;
                        ?>
                     </span></div>
                     <div class="door-del-note">
                        <div class="door-del-note-items">
                           <i class="fas fa-exclamation-circle"></i>

                           <ul>
                              <li> Select pick-up station to enjoy <br>
                                    - Scheduled pickup at your own convenience</li>

                              <li> - Large items (e.g. Freezers) may arrive 2 business days later than other products.</li>

                              <li> -   Living in Lagos, Abuja or Ibadan, <a href="#">SHOPPING PRIME</a> Members enjoy Free Delivery on All Local orders (excluding bulky items) and Jumia Food Orders.</li>

                              <li> - Receive free delivery on your Jumia Express orders above N12,000 in Lagos</li>

                              <li> - Please note that payment must be made before the package can be opened and delivery agents are not allowed to open a package.
                              For more information on returns please <a href="#">right click here!</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="pick-station">
                  <h5>SELECT PICK STATION</h5>

                  <div class="shipment-details">
                     <h5>SHIPMENT DETAILS</h5>

                     <div class="shipment">
                        <h6>Shipping 1 of 1</h6>

                     <?php
                        $shipping = "SELECT * FROM cart WHERE user_id=$id";
                        $shipping_res = mysqli_query($conn, $shipping);
                        $count_shipping = mysqli_num_rows($shipping_res);

                        if($count_shipping>0){
                           while($shipping_row = mysqli_fetch_assoc($shipping_res)){
                              $item_id = $shipping_row['prod_id'];

                              $ship = "SELECT * FROM products WHERE prod_id=$item_id";
                              $ship_res = mysqli_query($conn, $ship);

                              if(mysqli_num_rows($ship_res)==1){
                                 $ship_row = mysqli_fetch_assoc($ship_res);
                           ?>
                              <div class="shipment-item">
                                 <?php echo $shipping_row['qty'] . "x " . $ship_row['prod_name'] . " - " . $ship_row['description'] ?>  
                              </div>
                           <?php
                              }
                           }
                        }
                     ?>

                        <div class="delivery-time">Delivered by <span>
                           <?php
                              $date = Date("l j M", strtotime("+7 day"));
                              echo $date;
                           ?>
                        </span></div>

                        <div class="shop-exp">SHOPPING <span> <i class="fas fa-paper-plane"></i> Express</span></div>
                     </div>
                  </div>
               </div>


               <div class="shipment-total">
                  <div class="desc">
                     <div class="text">Subtotal</div>
                     <div class="subtotal">&#8358; <span>
                     <?php
                        echo $cart_row['total'];
                     ?>
                     </span></div>
                  </div>
                  <div class="desc">
                     <div class="text">Delivery Fee</div>
                     <div class="subtotal">&#8358; <span><?= $shipping_fee ?></span></div>
                  </div>
                  <div class="desc">
                     <div class="text">Express Free Shipping</div>
                     <div class="subtotal"> -&#8358; <span><?= $shipping_fee ?></span></div>
                  </div>

                  <hr>

                  <div class="desc">
                     <div class="text">Total</div>
                     <div class="subtotal"> &#8358; <span>
                        <?php
                           echo $cart_row['total'];
                        ?>
                     </span></div>
                  </div>
               </div>

               <br><br>

               <p class="add_voucher">You will be able to add a voucher in the next step</p>
               <a href="<?= SITEURL ?>user/checkout-payment.php" class="proceed_next">PROCEED TO NEXT STEP</a>
            </div>
         </div>
      </div>
   </div>


<!-- Order summary - items and shipping price -->
   <div class="order-summary">
      <h4>order summary</h4>

   <?php
      $query = "SELECT prod_id, qty FROM cart WHERE user_id=$id";
      $result = mysqli_query($conn, $query);
      $count1 = mysqli_num_rows($result);

   ?>
      <div class="order-details">
         <div class="order-head">
            <h3>your order <span>(<?php echo $count1 ?> items)</span></h3>
         </div>

   <?php
      if($count1>0){
         while($rows = mysqli_fetch_assoc($result)){
            $prod_id = $rows['prod_id'];

            $get_prod = "SELECT * FROM products WHERE prod_id=$prod_id";
            $prod_res = mysqli_query($conn, $get_prod);
            $count_prod = mysqli_num_rows($prod_res);

            if($count_prod==1){
               $prod_row = mysqli_fetch_assoc($prod_res);

            ?>
               <div class="order-items">
                  <div class="item-img">
                     <?php
                        if($prod_row['image_name'] !=""){
                     ?>
                        <img src="../images/products/<?= $prod_row['image_name']; ?>" alt="">
                     <?php
                        }
                     ?>
                  </div>

                  <div class="item-spec">
                     <div class="name-desc"><?php echo $prod_row['prod_name'] . ". " . $prod_row['description'] ?></div>
                     <div class="item-price">&#8358; <span>
                        <?php
                           $net_price = ((100-$prod_row['discount']) * $prod_row['price'])/100;
                           echo $net_price;
                        ?>
                     </span></div>
                     <div class="item-qty">Qty: <span><?= $rows['qty'] ?></span></div>
                  </div>
               </div>
            <?php
            }
         }
      }
   ?>

      <!-- total up items to checkout -->
         <div class="total-box">
            <div class="subtotal">
               <div>Subtotal</div>
               <div>&#8358; <span>
                  <?php
                     echo $cart_row['total'];
                  ?>
               </span></div>
            </div>
            <div class="delivery-fee">
               <div>Delivery Fee</div>
               <div>&#8358; <span><?= $shipping_fee ?></span></div>
            </div>
            <div class="total">
               <div>Total</div>
                  <div>&#8358; <span>
                     <?php 
                        echo $cart_row['total'] + $shipping_fee;
                     ?>
                  </span>
               </div>
            </div>

            <div class="modify-cart"><a href="<?= SITEURL ?>user/cart.php">modify cart</a></div>
         </div>
      <!-- total ends here -->
      </div>

      <!-- Need help section starts here -->
      <div class="live-chat">
         <h3>Need help?</h3>
         <p>Contact an expert to help you</p>
         <button><i class="fas fa-comment"></i>&nbsp; live chat</button>
      </div>
      <!-- Need help section ends here -->
   </div>
</section>


<?php include "../partials/footer.php"; ?>