<?php
   $caption = "Cart";
   include "../partials/header.php";
?>

<section class="cart" id="cart">

<?php

if(isset($_SESSION['id'])){
   $sql = "SELECT * FROM cart WHERE user_id=$id";
   $res = mysqli_query($conn, $sql);
   $count = mysqli_num_rows($res);          

      if($count>0){
      ?>
         <h1 class="cart-title">Cart <span>(<?php echo $count ?> items)</span></h1>
         <p>Your order is eligible for free shipping (lagos only, excluding large items) <i class="fas fa-question-circle"></i></p>

         <div class="cart-item">
            <ul>
               <li class="card-head">
                  <div>items</div>
                  <div>quantity</div>
                  <div>unit price</div>
                  <div>sub-total</div>
               </li>
      <?php

         while($rows = mysqli_fetch_assoc($res)){
            $prod_id = $rows['prod_id'];

         $query = "SELECT * FROM products WHERE prod_id=$prod_id";
         $result = mysqli_query($conn, $query);
         $count_row = mysqli_num_rows($result);

         if($count_row==1){
            $row = mysqli_fetch_assoc($result);
         ?>
            <li>
               <div class="item-details">
                  <div class="item-img">
                  <?php
                     if($row['image_name'] !==""){
                  ?>
                     <img src="../images/products/<?php echo $row['image_name']; ?>">
                  <?php
                     }
                  ?>
                  </div>
                  <div class="item-desc">
                     <h4 class="item-title"><?php echo $row['prod_name'] . " - " . $row['spec'] . " - " . $row['description'] ?></h4>
                     <div class="item-cat">item category: <span><?php echo $row['category_name'] ?></span></div>
                     <!-- <p class="item-text"><?php echo $row['spec'] . " - " . $row['description'] ?></p> -->

                     <div class="action">
                        <a onclick="saveItem(event, <?php echo $id ?>, <?php echo $row['prod_id'] ?>)" class="saved-item" href="<?php echo SITEURL ?>user/save-item.php?prod_id=<?php echo $row['prod_id'] ?>&user_id=<?php echo $id ?>">
                           <?php
                              $upd_status = "SELECT status FROM saved_prod WHERE user_id=$id AND prod_id=$prod_id";
                              $upd_status_res = mysqli_query($conn, $upd_status);
                              $count_status = mysqli_num_rows($upd_status_res);
                              
                              if($count_status==1){
                                 $status_row = mysqli_fetch_assoc($upd_status_res);
                                 $status_val = $status_row['status'];

                                 if($status_val==1){
                                    echo "<i class='fas fa-heart'></i> ADDED TO SAVED ITEMS";
                                 }
                                 else{
                                    echo "<i class='far fa-heart'></i> MOVE TO SAVED ITEMS";
                                 }
                              }
                              else{
                                 echo "<i class='far fa-heart'></i> MOVE TO SAVED ITEMS";
                              }
                           ?>
                        </a>

                        <a class="remove-item" href="<?php echo SITEURL ?>user/del-cart-item.php?prod_id=<?php echo $row['prod_id'] ?>&user_id=<?php echo $id ?>"><i class="fas fa-trash"></i>REMOVE</a>
                     </div>
                  </div>
               </div>
               
               <!-- cart qty -->
               <div class="cart-qty">
                  <?php
                     $query_qty = "SELECT * FROM cart WHERE prod_id=$prod_id AND user_id=$id";
                     $qty_res = mysqli_query($conn, $query_qty);
                     $qty_row = mysqli_fetch_assoc($qty_res);
                     
                     $pid = $qty_row['prod_id'];

                     if($row['qty'] == 0){
                        echo "<div class='sold-out'>Sold Out</div>";
                     }
                     else{
                  ?>
                     <form action="" method="">
                        <select name="qty" onchange="computeCart(event, this.value, <?php echo $pid ?>, <?php echo $id ?>)">
                           <?php
                                 for($qty = 1; $qty <= $row['qty']; $qty++){
                              ?>
                                 <option value="<?= $qty ?>" <?php if($qty == $qty_row['qty']) { echo "selected"; } ?>><?= $qty ?></option>
                              <?php
                                 }
                           ?>
                        </select>
                     </form>
                  <?php
                     }
                  ?>

               </div>
               
               <!-- Cart Items Pricing -->
               <div class="unit-price">
                  <div class="current-price">&#8358; <span>
                  <?php
                     $net_price = ((100-$row['discount']) * $row['price'])/100;
                     echo $net_price;
                  ?>
               </span></div>
                  <div class="actual-price">&#8358; <span><?php echo $row['price'] ?></span></div>
                  <div class="saving">Saving &#8358; <span>
                     <?php
                        $saving = $row['price'] - $net_price;
                        echo $saving;
                     ?>
                  </span></div>
               </div>

               <div class="sub-total">&#8358;&nbsp;<span><?= $qty_row['qty'] * $net_price ?></span></div>
            </li>
         <?php

            }
         }
      }
      else{
   ?>
      <h1 class="cart-title">No Cart Item</span></h1>
      <p>Your order is eligible for free shipping (lagos only, excluding large items) <i class="fas fa-question-circle"></i></p>

      <!-- displays empty when if user not logged in -->
         <div class="empty-cart">
            <div class="content">
                  <div class="cart-icon"><i class="fas fa-shopping-cart"></i></div>
                  <p>your cart is empty!</p>
                  <a href="<?php echo SITEURL; ?>user/index.php" class="start-shop">start shopping</a>
            </div>
         </div>
      <!-- Empty user cart ends here -->
   <?php
      }
   ?>

   </ul>
</div>

<div class="summary">
   <div class="total-price">
      <div class="total">total:</div>
      <div class="sum">&#8358; <span>
         <?php
            $cart_total = "SELECT SUM(price*qty) as total FROM cart WHERE user_id=$id";
            $cart_res = mysqli_query($conn, $cart_total);
            $cart_row = mysqli_fetch_assoc($cart_res);
               echo $cart_row['total'];
         ?>
         </span>
      </div>
   </div>

   <p class="delivery-note">Delivery fee not included yet</p>
   <p class="order-shipping-note">Your order is eligible for free shipping (lagos only, exluding large items) <i class="fas fa-question-circle"></i></p>
   
   <div class="checkout-btn">
      <a class="continue-shopping" href="<?php echo SITEURL; ?>user/index.php">continue shopping</a>
      <a class="checkout" href="<?php echo SITEURL; ?>user/checkout.php">proceed to checkout</a>
   </div>
</div>
<?php
}
else{
?>
<!-- displays empty when if user not logged in -->
<h1 class="cart-title">No Cart Item</span></h1>
<p>Your order is eligible for free shipping (lagos only, excluding large items) <i class="fas fa-question-circle"></i></p>

   <div class="empty-cart">
      <div class="content">
            <div class="cart-icon"><i class="fas fa-shopping-cart"></i></div>
            <p>your cart is empty!</p>
            <p>already have an account? <a href="<?php echo SITEURL; ?>customer/login.php">login</a> to see the items in your cart</p>
            <a href="<?php echo SITEURL; ?>user/index.php" class="start-shop">start shopping</a>
      </div>
   </div>
<!-- Empty user cart ends here -->
<?php
}
?>
   
</section>

<?php include "../partials/footer.php"; ?>