<section class="top-selling" id="top-selling">
   <div class="top-selling-box">
      <h4>Top Selling Items</h4>

      <div class="top-selling-items-list top-sells-slide">

      <?php
         $sql = "SELECT SUM(qty) as qty, prod_id FROM orders WHERE order_status='Delivered' GROUP BY prod_id ORDER BY qty DESC LIMIT 10";
         $res = mysqli_query($conn, $sql);
         $count = mysqli_num_rows($res);

         if($count>0){
            while($rows = mysqli_fetch_assoc($res)){
               $prod_id = $rows['prod_id'];

               $get_prod = "SELECT * FROM products WHERE prod_id=$prod_id";
               $get_prod_res = mysqli_query($conn, $get_prod);
               $count_prod = mysqli_num_rows($get_prod_res);

               if($count_prod==1){
                  $prod_row = mysqli_fetch_assoc($get_prod_res);
                  $disc = $prod_row['discount'];
               ?>
                  <div class="top-selling-item">
                     <a href="<?php echo SITEURL ?>user/view-item.php?prod_id=<?php echo $prod_row['prod_id'] ?>">
                        <div class="item-discount"><?php echo -$disc . "%"; ?></div>
                     
                        <div class="view-img">
                           <?php
                              if($prod_row['image_name'] !=""){
                           ?>
                              <img src="../images/products/<?= $prod_row['image_name'] ?>" class="">
                           <?php
                              }
                           ?>
                        </div>
            
                        <div class="item-det">
                           <div class="item-desc"><?php echo $prod_row['prod_name']." - ".$prod_row['spec']; ?></div>
                           <h5>&#8358; <span>
                              <?php
                                 $net_price = ((100-$disc) * $prod_row['price'])/100;
                                 echo $net_price;
                              ?>
                           </span></h5>

                           <p>&#8358; <span><?php echo $prod_row['price']?></span></p>
                        </div>
                     </a>
                  </div>
               <?php
               }
            }
         }
      ?>
      
      </div>
   </div>
</section>