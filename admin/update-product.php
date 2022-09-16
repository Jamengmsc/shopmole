<?php
   include "../config/constants.php";

   if(isset($_GET['prod_id'])){
      $prod_id = $_GET['prod_id'];

      $prod_name = $_POST['name'];
      $brand_name = $_POST['brand'];
      $spec = $_POST['spec'];
      $desc = $_POST['desc'];
      $price = $_POST['price'];
      $cat_name = $_POST['category'];
      $shop_name = $_POST['shop'];
      $qty = $_POST['qty'];
      $discount = $_POST['discount'];

      if(isset($_POST['active'])){
         $active = $_POST['active'];
      }

      // Work on this
      if(isset($_FILES['new_image']['name'])){
         $image_name = $_FILES['new_image']['name'];
         $img_path = $_FILES['new_image']['tmp_name'];
         $dest = "../images/products/";

      }

      $upd_prod = "UPDATE products SET
         prod_name='$prod_name',
         shop_name='$shop_name',
         category_name='$cat_name',
         brand_name='$brand_name',
         spec='$spec',
         description='$desc',
         price=$price,
         discount=$discount,
         qty=$qty,
         active='$active'

         WHERE prod_id=$prod_id
      ";

      $upd_prod_res = mysqli_query($conn, $upd_prod);
      if($upd_prod_res==true){
         echo "success";
      }
   }
?>