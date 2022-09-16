<?php
   $caption = "Add Product";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 setup">
   <div class="d-flex justify-content-between align-items-center">
      <h4 class="gen_setup">Add New Product</h4>

      <?php
         if(isset($_SESSION['add-product'])){
            echo $_SESSION['add-product'];
            unset($_SESSION['add-product']);
         }
      ?>
   </div>
   <hr>

   <form action="" method="POST" enctype="multipart/form-data">
      <div class="row">
         <div class="col-lg-9 col-md-7 col-sm-12">
            <div class="form-group">
               <label for="name">Product Name</label><br>
               <input type="text" name="name" placeholder="Product Name...">
            </div>
         </div>

         <div class="col-lg-3 col-md-5 col-sm-12">
            <div class="form-group active">
               <label for="active" class="mr-3">Active</label>
               Yes <input type="radio" name="active" value="Yes"> &nbsp;
               No <input type="radio" name="active" value="No">
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col">
            <div class="form-group">
               <label for="specification">Specification</label><br>
               <input type="text" name="spec" placeholder="Specification...">
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col">
            <div class="form-group">
               <label for="description">Descritpion</label><br>
               <textarea name="desc" id="" cols="30" rows="2" placeholder="Product description..."></textarea>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-4">
            <div class="form-group">
               <label for="price">Price</label><br>
               <input type="text" name="price" placeholder="Price...">
            </div>
         </div>
         <div class="col-2">
            <div class="form-group">
               <label for="discount">Discount</label><br>
               <input type="number" name="discount" placeholder="Discount...">
            </div>
         </div>
         <div class="col-2">
            <div class="form-group">
               <label for="qty">Quantity</label><br>
               <input type="number" name="qty" placeholder="Qty...">
            </div>
         </div>
         <div class="col-4">
            <div class="form-group">
               <label for="image">Product Image</label><br>
               <input type="file" name="image" class="">
            </div>
         </div>
      </div>

      <div class="row">
      <div class="col-4">
            <div class="form-group">
               <label for="shop">Shop</label><br>
               <select onchange="loadCategory(this.value)" name="shop" id="my_shop">
                  <option value="select" disabled selected>-Select Shop-</option>

                  <?php
                     $sql = "SELECT id, shop_name FROM shops ORDER BY shop_name";
                     $res = mysqli_query($conn, $sql);
                     $count = mysqli_num_rows($res);

                     if($count>0){
                        while($shop_rows = mysqli_fetch_assoc($res)){
                           $shop_id = $shop_rows['id'];
                     ?>
                        <option value="<?= $shop_rows['shop_name'] ?>"><?= $shop_rows['shop_name'] ?></option>
                     <?php
                        }
                     }
                  ?>

               </select>
            </div>
         </div>

         <div class="col-4">
            <div class="form-group">
               <label for="category">Category Name</label><br>
               <select onchange="loadBrand(this.value)" name="category" id="shop_category">
                  <option value="select" selected disabled>-Select Category-</option>
               </select>
            </div>
         </div>
         
         <div class="col-4">
            <div class="form-group">
               <label for="brand">Brand</label><br>
               <select name="brand" id="cat_brand">
                  <option value="" disabled selected>-Select Brand-</option>
               </select>
            </div>
         </div>
      </div>

      <input type="submit" id="add_prod" name="submit" value="Add Product">
   </form>

<?php
   if(isset($_POST['submit'])){
      // Get form data
      $prod_name = $_POST['name'];
      $spec = $_POST['spec'];
      $desc = $_POST['desc'];
      $price = $_POST['price'];
      $qty = $_POST['qty'];
      $discount = $_POST['discount'];
      
      // Select Shop of Product
      if(isset($_POST['shop'])){
         $sel_shop_id = $_POST['shop'];
      }
      else{
         echo "Please, select a shop for this product";
         die();
      }
      
      // Select Category of Product
      if(isset($_POST['category'])){
         $sel_cat_id = $_POST['category'];
      }
      else{
         echo "Please, select a category for this product";
         die();
      }
      
      // Select Brand of Product
      if(isset($_POST['brand'])){
         $sel_brand_id = $_POST['brand'];
      }
      else{
         echo "Please, select a brand for this product";
         die();
      }
      
      if(isset($_POST['active'])){
         $active = $_POST['active'];
      }
      else{
         $active = "Yes";
      }

      // Upload Product Image
      if(isset($_FILES['image']['name'])){
         $image_name = $_FILES['image']['name'];

         $exp = explode(".", $image_name);
         $img_ext = end($exp); //Image extension

         $image_name = "Product_" . rand(000, 999) . "." . $img_ext; //Custom product name

         $img_src = $_FILES['image']['tmp_name'];
         $img_dest = "../images/products/" . $image_name;

         $upload_img = move_uploaded_file($img_src, $img_dest);

         if($upload_img==false){
            $_SESSION['add-product'] = "Failed to Upload Product Image";
            echo "<script>location.href='add-product.php'</script>";
            die();
         }
         else{
         }
      }
      else{
         $image_name = "";
      }

      // Query the database
      $query = "INSERT INTO products SET
         brand_name = '$sel_brand_id',
         category_name = '$sel_cat_id',
         shop_name = '$sel_shop_id',
         prod_name = '$prod_name',
         spec = '$spec',
         description = '$desc',
         price = $price,
         qty = $qty,
         discount = $discount,
         image_name = '$image_name',
         active = '$active'
      ";

      $result = mysqli_query($conn, $query);

      if($result==true){
         $_SESSION['add-product'] = "<div class='mb-2'>Product Successfully Added</div>";
         echo "<script>location.href='products-list.php'</script>";
      }
      else{
         $_SESSION['add-product'] = "Failed To Add Product";
         echo "<script>location.href='add-product.php'</script>";
      }
   }
?>

</div>

<?php include "../partials/admin-footer.php"; ?>