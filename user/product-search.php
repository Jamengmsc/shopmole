<?php
   $caption = "Shop All Products";
   include "../partials/header.php";
?>

<section class="product-search">
   <div class="search_prod_pane">
      <div class="prod_category">
         <h4>Category</h4>
         <a href="<?php echo SITEURL ?>user/search-store.php?store=computing">computing</a>
         <a href="<?php echo SITEURL ?>user/search-store.php?store=electronics">Electronics</a>
         <a href="<?php echo SITEURL ?>user/search-store.php?store=phones">phones & tablets</a>
         <a href="<?php echo SITEURL ?>user/search-store.php?store=fashion">fashion</a>
         <a href="<?php echo SITEURL ?>user/search-store.php?store=machines">machines & tools</a>
         <a href="<?php echo SITEURL ?>user/search-store.php?store=baby">baby products</a>
         <a href="<?php echo SITEURL ?>user/search-store.php?store=games">gaming</a>
         <a href="<?php echo SITEURL ?>user/search-store.php?store=home">homes & offices</a>
      </div>

      <div class="brand_pane">
         <h4>Brand</h4>

         <form action="" method="post">
            <input type="search" name="pane_search" id="" placeholder="Search...">
            <i class="fas fa-search"></i>
         </form>

         <div class="brand_search_opt">
            <div class="brand_opt_item">

            <?php
               $sql = "SELECT brand_name FROM brands WHERE active='Yes' ORDER BY brand_name";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);

               if($count>0){
                  while($rows = mysqli_fetch_assoc($res)){
                     $brand_name = $rows['brand_name'];
                  ?>
                     <a href="#">
                        <div class="opt_box"></div>
                        <div class="brand_name"><?= $brand_name; ?></div>
                     </a>
                  <?php
                  }
               }
            ?>
               
            </div>
         </div>

      </div>
   </div>

<!-- Product side of search -->
   <div class="all_search_prod">
      <div class="all_prod_head">
         <h3><a style="color:rgba(0,0,0,.8);" href="#" onclick="history.go(-1)"><i class="fas fa-arrow-left"></i></a> &nbsp; Shop Online In Nigeria</h3>
         <div id="popular" class="popularity">
            <span>Sort by:</span> Popularity <i class="fas fa-chevron-down"></i>

            <!-- Popularity dropdown -->
            <ul class="popularity_dropdown d-none">
               <li><a href="#">Popularity</a></li>
               <li><a href="#">New Arrivals</a></li>
               <li><a href="#">Price: Low To High</a></li>
               <li><a href="#">Price: High To Low</a></li>
               <li><a href="#">Product Rating</a></li>
            </ul>
         </div>
      </div>

   <?php
      if(isset($_SESSION['search-app'])){
         $search = $_SESSION['search-app'];
      }

      $query = "SELECT * FROM products WHERE prod_name LIKE '%$search%' OR spec LIKE '%$search%' OR description LIKE '%$search%' OR brand_name LIKE '%$search%' OR category_name LIKE '%$search%' OR shop_name LIKE '%$search%' AND active='Yes'";
      $result = mysqli_query($conn, $query);
      $count_res = mysqli_num_rows($result);
   ?>

      <!-- Items found and view style -->
      <div class="found_view_style">
         <div class="found_prod_no"><span><?php echo $count_res ?></span> products found</div>
         <div class="view_style">
            <i class="fas fa-th-list"><i class="fas fa-th-large"></i></i></div>
      </div>

      <!-- Found products list -->
      <div class="found_products">

      <?php
         if($count_res>0){
            while($row = mysqli_fetch_assoc($result)){
         
           ?>
               <a href="<?php echo SITEURL ?>user/view-item.php?prod_id=<?php echo $row['prod_id'] ?>">
                  <div class="found_prod_item">
                     <div class="prod_img">
                        <?php
                           if($row["image_name"] !=""){
                        ?>
                           <img src="../images/products/<?php echo $row['image_name'] ?>">
                        <?php
                           }
                        ?>
                     </div>
   
                     <div class="prod_desc">
                        <?php echo $row["prod_name"] . " - " . $row["spec"] . " " . $row["description"] ?>
                     </div>
                     <div class="prod_price">&#8358; <span class="num"><?php echo $row['price'] ?></span></div>
   
                     <p>Eligible for Free Shipping with Shopmole Express OR Shopmole Prime</p>
   
                     <button class="add_prod">View Product</button>
                  </div>
               </a>
            <?php
         }
      }
      ?>

      </div>
   </div>

</section>


<?php include "../partials/footer.php"; ?>