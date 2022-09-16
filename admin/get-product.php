<?php include "../config/constants.php"; ?>

<?php
   if(isset($_GET['q'])){
      $prod_id = $_GET['q'];

      $sql = "SELECT * FROM products WHERE prod_id='".$prod_id."'";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if($count==1){
         while($row=mysqli_fetch_assoc($res)){
      ?>
         <form action="" method="post" enctype="multipart/form-data" style="width: 90%;" class="mt-3 prod_upd_form">
            <div class="row">
               <div class="col-8">
                  <div class="form-group">
                     <label for="name">Product Name</label><br>
                     <input type="text" name="name" value="<?= $row['prod_name'] ?>">
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group active">
                     <label for="active" class="mr-3">Active</label>
                     Yes <input type="radio" name="active" value="Yes" <?php if($row['active']=="Yes"){ echo "checked"; } ?>> &nbsp;
                     No <input type="radio" name="active" value="No" <?php if($row['active']=="No"){ echo "checked"; } ?>>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col">
                  <div class="form-group">
                     <label for="specification">Specification</label><br>
                     <input type="text" name="spec" style="width: 95%;" value="<?= $row['spec'] ?>">
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col">
                  <div class="form-group">
                     <label for="description">Descritpion</label><br>
                     <textarea name="desc" style="width: 95%;" cols="30" rows="2" value=""><?= $row['description'] ?></textarea>
                  </div>
               </div>
            </div>

            <div class="row mt-n3 mb-2 no-gutters">
               <div class="col-8">
                  <div class="row">
                     <div class="col-5">
                        <div class="form-group">
                           <label for="price">Price</label><br>
                           <input type="text" name="price" value="<?= $row['price'] ?>">
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="form-group">
                           <label for="qty">Discount</label><br>
                           <input type="number" name="discount" value="<?= $row['discount'] ?>">
                        </div>
                     </div>
                     <div class="col-3">
                        <div class="form-group">
                           <label for="qty">Quantity</label><br>
                           <input type="number" name="qty" value="<?= $row['qty'] ?>">
                        </div>
                     </div>
                  </div>

                  <!-- Description of item shop, category and brand -->
                  <div class="row no-gutters">
                     <div class="col-4 pr-1">
                        <div class="form-group">
                           <label for="shop">Shop</label><br>
                           <select name="shop" id="">
                              <?php
                                 $que1 = "SELECT shop_name FROM shops WHERE active='Yes'";
                                 $que_res1 = mysqli_query($conn, $que1);
                                 $count_rw1 = mysqli_num_rows($que_res1);
                                 if($count_rw1>0){
                                    while($que_row1 = mysqli_fetch_assoc($que_res1)){
                                 ?>
                                    <option value="<?= $que_row1['shop_name'] ?>" <?php if($row['shop_name'] == $que_row1['shop_name']){ echo "selected"; } ?>><?= $que_row1['shop_name'] ?></option>
                                 <?php
                                    }
                                 }
                              ?> 
                           </select>
                        </div>
                     </div>

                     <div class="col-4 pr-1">
                        <div class="form-group">
                           <label for="category">Category</label><br>
                           <select name="category" id="">
                              <?php
                                 $que = "SELECT cat_name FROM category WHERE active='Yes'";
                                 $que_res = mysqli_query($conn, $que);
                                 $count_rw = mysqli_num_rows($que_res);
                                 if($count_rw>0){
                                    while($que_row = mysqli_fetch_assoc($que_res)){
                                 ?>
                                    <option value="<?= $que_row['cat_name'] ?>" <?php if($row['category_name'] == $que_row['cat_name']){ echo "selected"; } ?>><?= $que_row['cat_name'] ?></option>
                                 <?php
                                    }
                                 }
                              ?>  
                           </select>
                        </div>
                     </div>

                     <div class="col-4">
                        <div class="form-group">
                           <label for="brand">Brand</label><br>
                           <select name="brand" id="">
                              <?php
                                 $que2 = "SELECT brand_name FROM brands WHERE active='Yes'";
                                 $que_res2 = mysqli_query($conn, $que2);
                                 $count_rw2 = mysqli_num_rows($que_res2);
                                 if($count_rw2>0){
                                    while($que_row2 = mysqli_fetch_assoc($que_res2)){
                                 ?>
                                    <option value="<?= $que_row2['brand_name'] ?>" <?php if($row['brand_name'] == $que_row2['brand_name']){ echo "selected"; } ?>><?= $que_row2['brand_name'] ?></option>
                                 <?php
                                    }
                                 }
                              ?> 
                           </select>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-4 pl-4">
                  <div class="form-group">
                     <label for="image">Product Image</label>
                     <div class="prod_img mt-0">
                        <?php
                           if($row['image_name'] !=""){
                        ?>
                           <img src="../images/products/<?php echo $row['image_name'] ?>" class="img-fluid" alt="product name here">
                        <?php
                           }
                        ?>
                     </div>
                     <input type="file" name="new_image" class="ml-n2">
                  </div>
               </div>
            </div>

            <a onclick="updateProd(event, <?php echo $row['prod_id'] ?>)" href="<?php echo SITEURL ?>admin/update-product.php?item_id=<?php echo $row['prod_id']; ?>" id="upd_btn">Update Product</a>

            <a href="<?php echo SITEURL ?>admin/delete-product.php?item_id=<?php echo $row['prod_id']; ?>" id="del_btn">Delete Product</a>
         </form>
      <?php
         }
      }
   }
