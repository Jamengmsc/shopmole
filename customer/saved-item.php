<?php
   $caption = "Saved Items";
   include "../partials/header.php";
   include "../config/auth.php";
?>


   <!-- Saved items starts -->
   <section class="saved-items" id="saved-items">
      <div class="wrapper">
         <?php include "../partials/sidemenu.php"; //Sidemenu for customers' page ?>

         <div class="main-saved">
      <?php
         $sql = "SELECT * FROM saved_prod WHERE user_id=$id AND status=1";
         $res = mysqli_query($conn, $sql);
         $count = mysqli_num_rows($res);

         if($count>0){
         ?>
            <h4 class="title">SAVED ITEMS <span>(<?= $count ?>)</span></h4>
         <?php
            while($rows = mysqli_fetch_assoc($res)){
               $prod_id = $rows['prod_id'];

            // Get product details from products table in database
            $prod_details = "SELECT * FROM products WHERE prod_id=$prod_id";
            $prod_details_res = mysqli_query($conn, $prod_details);
            $count_details = mysqli_num_rows($prod_details_res);

               if($count_details==1){
                  while($row_details = mysqli_fetch_assoc($prod_details_res)){
               ?>
                  <!-- Saved item -->
                  <div class="items <?php if($row_details['qty']==0) { echo "out-of-stock"; } ?>">
                     <div class="item-img">
                     <?php
                        if($row_details['image_name'] !=""){
                     ?>
                        <img src="../images/products/<?= $row_details['image_name']; ?>" alt="">
                     <?php
                        }
                     ?>
                     </div>
         
                     <div class="item-desc">
                        <div class="item-name">
                           <?= $row_details['prod_name'] . " - " . $row_details['spec'] . " - " . $row_details['description'] ?>
                        </div>
                        <div class="item-pricing">
                           <h4 class="net-price">&#8358; <span>
                              <?php
                                 $net_price = ((100-$row_details['discount']) * $row_details['price'])/100;
                                 echo $net_price;
                              ?>
                           </span></h4>
         
                           <div class="priceDisc">
                              <div class="actPrice">&#8358; <span><?= $row_details['price'] ?></span></div>
                              <div class="percDiscount"><?php echo -$row_details['discount'] . "%"; ?></div>
                           </div>
                        </div>
                     </div>
         
                     <div class="actionBtn">
                        <a href="#" class="buy-now">Buy Now</a>
                        <button class="oof" disabled>out of stock</button>
                        <a href="<?php echo SITEURL ?>customer/delete-saved.php?prod_id=<?php echo $row_details['prod_id'] ?>&user_id=<?php echo $id ?>" class="remove-item"><i class="fas fa-trash"></i> Remove</a>
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
   </section>
   <!-- Saved items ends -->

   <!-- top selling item starts here -->
   <?php include "../partials/top-selling.php"; ?>
   <!-- top selling items section ends here -->

   <!-- recently viewed items -->
   <?php include "../partials/views-recent.php"; ?>
   <!-- recently viewed items ends here -->

   
<?php include "../partials/footer.php"; ?>