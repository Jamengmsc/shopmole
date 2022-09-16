<section class="recently-viewed" id="recently-viewed">
   <div class="recently-viewed-box">

      <h4 style="padding:15px">Recently Viewed Items</h4>
      <!-- <hr style="margin-bottom:10px; margin-top:0"> -->
      <div class="recently-viewed-items-list recent-view-slide">
      
      <?php
         $sql = "SELECT DISTINCT prod_id FROM recent_viewed ORDER BY view_date DESC LIMIT 10";
         $res = mysqli_query($conn, $sql);
         $count = mysqli_num_rows($res);

         if($count>0){
            while($rows = mysqli_fetch_assoc($res)){
               $prod_id = $rows['prod_id'];
               
               // Get product details at the current product ID in the loop
               $prod_details = "SELECT * FROM products WHERE prod_id=$prod_id";
               $prod_details_res = mysqli_query($conn, $prod_details);
               $count_prod_det = mysqli_num_rows($prod_details_res);

               if($count_prod_det==1){
                  $row = mysqli_fetch_assoc($prod_details_res);
                  $disc = $row['discount'];
                  $price = $row['price'];
               }
         ?>
            <div class="recently-viewed-item">
               <a href="<?php echo SITEURL ?>user/view-item.php?prod_id=<?php echo $row['prod_id'] ?>">
                  <div class="item-discount"><?php echo -$disc . "%"; ?></div>
                  
               <div class="view-img">
                  <?php
                     if($row['image_name'] !=""){
                  ?>
                     <img src="../images/products/<?= $row['image_name'] ?>" alt="">
                  <?php
                     }
                  ?>
               </div>
      
                  <div class="item-det">
                     <div class="item-desc"><?php echo $row['prod_name']." - ".$row['spec']; ?></div>
                     <h5>&#8358; <span>
                        <?php
                           $net_price = ((100-$disc) * $price)/100;
                           echo $net_price;
                        ?>
                     </span></h5>
                     <p>&#8358; <span><?php echo $price ?></span></p>
                  </div>
               </a>
            </div>
         <?php
            }
         }
      ?>

      </div>
   </div>
</section>