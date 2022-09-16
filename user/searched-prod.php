<?php
   include "../config/constants.php";

   if(isset($_GET['search'])){
      $search = $_GET['search'];

      $output = "";

      $query = "SELECT * FROM products WHERE prod_name LIKE '%$search%' OR spec LIKE '%$search%' OR description LIKE '%$search%' OR brand_name LIKE '%$search%' OR category_name LIKE '%$search%' OR shop_name LIKE '%$search%' AND active='Yes'";
      $result = mysqli_query($conn, $query);
      $count_res = mysqli_num_rows($result);

      $_SESSION['prod-count'] = $count_res;

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

                  <button class="add_prod">Add To Cart</button>
               </div>
            </a>
         <?php
      }
   }
}
?>