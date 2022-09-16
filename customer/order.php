<?php
   $caption = "Orders";
   include "../partials/header.php";
   include "../config/auth.php";
?>


<!-- user account details starts -->
<section class="user-account orders" id="orders">
   <div class="wrapper">
      <?php include "../partials/sidemenu.php"; //Sidemenu for customers' page ?>

      <div class="main">
         <h5>Orders</h5>

         <?php
            $sql = "SELECT * FROM orders WHERE user_id=$id and active=1 GROUP BY order_id ORDER BY order_date DESC";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count>0){
            ?>
               <h4>open orders (<?php echo $count; ?>)</h4>
               <div class="order-list">
            <?php
               
               while($rows = mysqli_fetch_assoc($res)){
                  $order_id = $rows['order_id'];
               ?>
                  <!-- Each Order Item -->
                  <div class="each_order">
                     <div class="order-info">
                        <div class="order_detail">
                           <div class="order-nr">Order No: <span><?php echo $order_id ?></span></div>
                           <div class="order-date">Date: <span>
                              <?php
                                 $date = strtotime($rows['order_date']);
                                 echo $date = date('M d, Y', $date);
                              ?>
                           </span></div>
                        </div>

                        <a href="<?php echo SITEURL ?>customer/order-details.php?order_id=<?php echo $order_id ?>">See Details</a>
                     </div>

                     <div class="order_item">

                  <?php
                     $get_id = "SELECT prod_id, qty, order_status FROM orders WHERE order_id=$order_id";
                     $get_id_res = mysqli_query($conn, $get_id);
                     $count_id = mysqli_num_rows($get_id_res);

                     if($count_id>0){
                        while($id_row = mysqli_fetch_assoc($get_id_res)){
                           $prod_id = $id_row['prod_id'];
                           $prod_qty = $id_row['qty'];

                           $get_prod = "SELECT * FROM products WHERE prod_id=$prod_id";
                           $get_prod_res = mysqli_query($conn, $get_prod);
                           $count_prod = mysqli_num_rows($get_prod_res);

                           if($count_prod==1){
                              while($prod_row = mysqli_fetch_assoc($get_prod_res)){
                              
                           ?>
                              <div class="item <?php if($id_row['order_status'] == 'Cancelled'){ echo "cancel"; } ?>">
                                 <div class="item_img">
                                    <?php
                                       if($prod_row['image_name'] !=""){
                                    ?>
                                       <img src="../images/products/<?php echo $prod_row['image_name'] ?>" alt="<?php echo $prod_row['prod_name'] ?>">
                                    <?php
                                       }
                                    ?>
                                 </div>

                                 <div class="item_desc">
                                    <div class="item_name"><?php echo $prod_row['prod_name'] ?></div>
                                    <div class="item_qty">Qty: <span><?php echo $prod_qty ?></span></div>
                                    <div class="order_status"><?php echo $id_row['order_status'] ?></div>
                                 </div>
                              </div>
                           <?php
                           
                              }
                           }
                        }
                     }
                  ?>
                     </div>
                  </div>
               <?php
               }

            }
            else{
               echo "You Do Not Have Any Order!";
            }
         ?>

      </div>
   </div>
</section>
<!-- order html details ends -->

<!-- top selling item starts here -->
<?php include "../partials/top-selling.php"; ?>
<!-- top selling items section ends here -->

<!-- recently viewed items -->
<?php include "../partials/views-recent.php"; ?>
<!-- recently viewed items ends here -->

<?php include "../partials/footer.php"; ?>