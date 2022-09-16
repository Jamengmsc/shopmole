<?php
   $caption = "View Item";
   include "../partials/header.php";
?>

<?php
   if(isset($_GET['prod_id'])){
      $prod_id = $_GET['prod_id'];
      
      if(isset($id)){
         $user_id = $id;
         $viewed_date = date("Y-m-d H:i:s"); //Current date and time product is viewed...

         $sql1 = "SELECT * FROM recent_viewed WHERE prod_id=$prod_id AND user_id=$user_id";
         $res1 = mysqli_query($conn, $sql1);
         $count1 = mysqli_num_rows($res1);

         if($count1==0){
            $view_prod = "INSERT INTO recent_viewed SET
               user_id = $user_id,
               prod_id = $prod_id,
               view_date = '$viewed_date'
            ";

            $view_prod_res = mysqli_query($conn, $view_prod);
         }
         elseif($count1==1){
            // Update last view date of product
            $sql_viewed = "UPDATE recent_viewed SET view_date='$viewed_date' WHERE prod_id=$prod_id AND user_id=$user_id";
            $view_date_query = mysqli_query($conn, $sql_viewed);
         }
      }

      // Query database to upload product details
      $sql = "SELECT * FROM products WHERE prod_id=$prod_id";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if($count==1){
         $row = mysqli_fetch_assoc($res);
         $image_name = $row['image_name'];
         $prod_id = $row['prod_id'];
      }
   }
?>

<section class="view-item">

<?php
   if(isset($_SESSION['add-to-cart'])){
      echo $_SESSION['add-to-cart'];
      unset($_SESSION['add-to-cart']);
   }
?>

   <div class="view-item-box">
      <div class="item-detail">
         <div class="item-img">
      <?php
         if($row['image_name'] !=""){
         ?>
            <img src="../images/products/<?= $image_name ?>" alt="">
         <?php
         }
      ?>
         </div>

         <div class="item-description">
            <div class="item-name">
               <div class="name"><?= $row['prod_name'] . " - " . $row['spec'] . " - " . $row['description'] ?></div>

               <a href="<?php echo SITEURL ?>user/save-item.php?prod_id=<?php echo $row['prod_id'] ?>&user_id=<?php echo $id ?>" class="add-saved-items">

               <?php
                  if(isset($id)){
                     $upd_status = "SELECT status FROM saved_prod WHERE user_id=$user_id AND prod_id=$prod_id";
                     $upd_status_res = mysqli_query($conn, $upd_status);
                     $count_status = mysqli_num_rows($upd_status_res);
                     
                     if($count_status==1){
                        $status_row = mysqli_fetch_assoc($upd_status_res);
                        $status_val = $status_row['status'];

                        if($status_val==1){
                           echo "<i class='fas fa-heart'></i>";
                        }
                        else{
                           echo "<i class='far fa-heart'></i>";
                        }
                     }
                     else{
                        echo "<i class='far fa-heart'></i>";
                     }
                  }
                  else{
                     echo "<i class='far fa-heart'></i>";
                  }
               ?>

               </a>
            </div>

            <div class="itemSpec">
               <h5 class="specText">Specifications:</h5>
               <div class="specification"><?= $row['spec'] ?></div>
            </div>

            <div class="itemBrand">
               <div class="brandText">Brand:</div>
               <a href="" class="brandName"><?php echo $row['brand_name'] ?></a>
               <a href="" class="similarItem">similar product from <span><?php echo $row['brand_name']; ?></span></a>
            </div>

            <div class="item-category">
               <div class="categoryText">item category:</div>

               <a href="#" class="catName"><?php echo $row['category_name'] ?></a>
            </div>

            <div class="itemRating">
               <div class="rate">
                  <div class="ratingStars">
                     <i class="far fa-star"></i>
                     <i class="far fa-star"></i>
                     <i class="far fa-star"></i>
                     <i class="far fa-star"></i>
                     <i class="far fa-star"></i>
                  </div>
                  <div class="rating-details">(1 rating)</div>
               </div>

               <div class="genre">(Smartphone)</div>
            </div>
            <hr>

            <div class="itemPrice">
               <h1 class="netPrice">&#8358; <span>
                  <?php
                     $net_price = ((100-$row['discount']) * $row['price'])/100;
                     echo $net_price;
                  ?>
               </span></h1>
               <div class="priceDisc">
                  <div class="actPrice">&#8358; <span><?= $row['price'] ?></span></div>
                  <div class="percDiscount"><?= "-" . $row['discount'] . "%" ?></div>
               </div>
            </div>

            <div class="deliveryAmt">+Delivering at &#8358; 1,000 to Anthony (Lagos)</div>

            <hr>

            <span>VARIATION AVAILABLE</span>

            <?php
               if(isset($_SESSION['id'])){
               ?>
                  <div class="addItemToCart">
                     <a onclick="addToCart(event, <?php echo $row['prod_id'] ?>)" href="<?php echo SITEURL ?>user/add-to-cart.php?prod_id=<?php echo $row['prod_id'] ?>&user_id=<?php echo $id; ?>" class="add-cart">add to cart</a>
                  </div>
               <?php
               }
            ?>

         </div>
      </div>

      <div class="delivery-details">
         <div class="delivery-title">delivery & returns</div>
         <hr>
         <div class="choose-location">
            <h5>choose your location</h5>
            <div class="location-from">
               <select name="loc-from" id=""><option value="lagos">Lagos</option></select>
            </div>
            <div class="location-to">
               <select name="loc-from" id=""><option value="lagos">OWODE, IKORODU</option></select>
            </div>
         </div>
         <hr>

         <div class="delivery-type">
            <div><i class="fas fa-truck"></i></div>
            <div class="type">
               <h5>door delivery</h5>
               <div class="delivery-cost">&#8358; <span>1200</span></div>
               <p class="delivery-time">
                  Ready for delivery <span>between 13 september & 14 september</span> when you order within next <span>19hrs 48mins</span>
               </p>
            </div>
            <div><a href="#">Details</a></div>
         </div>
         <hr>

         <div class="return-policy">
            <div><i class="fas fa-undo-alt"></i></div>
            <div class="policy">
               <h5>return policy</h5>
               <p class="return-note">
                  Free return within 15 days for official store items and 7 days for other eligible items. <a href="#">see more</a>
               </p>
            </div>
         </div>
      </div>
   </div>

   <div class="product-details">
      <h4>product description</h4>
   </div>
</section>


<?php include "../partials/footer.php"; ?>
