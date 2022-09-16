<?php
   $caption = "Products List";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 all-products">
   <div class="d-flex justify-content-between align-items-center mt-3">
      <h4 class="gen_setup p-0">Products List</h4>
      <a href="<?php echo SITEURL ?>admin/add-product.php" class="text-info text-decoration-none">Add New Product</a>
   </div>
   <hr>

<?php
   if(isset($_SESSION['add-product'])){
      echo $_SESSION['add-product'];
      unset($_SESSION['add-product']);
   }
?>

   <table class="w-100">
      <!-- <thead> -->
      <tr>
         <th>S/N</th>
         <th>Product Name</th>
         <th class="px-3">Brand</th>
         <th>Specification</th>
         <th>Price</th>
         <th>Active</th>
      </tr>
      <!-- </thead> -->

   <?php
      $sql = "SELECT * FROM products WHERE active='Yes' ORDER BY prod_name LIMIT 20";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if($count>0){
         $sn = 1;
         while($rows = mysqli_fetch_assoc($res)){
      ?>
         <tr>
            <td class="px-2" style="width:4%"><?= $sn++ ?></td>
            <td style="width: 30%;"><a href="#" class="text-decoration-none"><?= $rows['prod_name'] ?></a></td>
            <td class="px-3" style="width:15%"><?php echo $rows['brand_name'] ?></td>
            <td style="width:40%"><?= $rows['spec'] ?></td>
            <td style="width: 15%;">&#8358; <span><?= $rows['price'] ?></span></td>
            <td style="width: 5%;"><?= $rows['active'] ?></td>
         </tr>
      <?php
         }
      }
      else{
      ?>
         <tr><td colspan="8" class="text-center text-danger font-italic font-weight-bold py-2" style="font-size:16px;">No Product Found</td></tr>
      <?php
      }
   ?>
      
   </table>
</div>

<?php include "../partials/admin-footer.php"; ?>