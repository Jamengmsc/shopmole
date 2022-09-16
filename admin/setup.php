<?php
   $caption = "General Setup";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5">
   <h4 class="gen_setup">General Setup</h4>
   <hr>

   <div class="row">
      <div class="col-6">
         <div class="setup-item">
            <h5>Products Setup</h5>

            <ul>
               <li><a href="<?php echo SITEURL ?>admin/products-list.php">See All Products</a></li>
               <li><a href="<?php echo SITEURL ?>admin/add-product.php">Add New Product</a></li>
               <li><a href="<?php echo SITEURL ?>admin/manage-product.php">Manage Products</a></li>
            </ul>
         </div>
      </div>

      <div class="col-6">
         <div class="setup-item">
            <h5>Categories Setup</h5>

            <ul>
               <li><a href="<?php echo SITEURL ?>admin/category-list.php">See All Categories</a></li>
               <li><a href="<?php echo SITEURL ?>admin/add-category.php">Add New Category</a></li>
               <li><a href="<?php echo SITEURL ?>admin/manage-category.php">Manage Category</a></li>
            </ul>
         </div>
      </div>
   </div>

   <hr>

   <div class="row">
      <div class="col-6">
         <div class="setup-item">
            <h5>Shops Setup</h5>

            <ul>
               <li><a href="<?php echo SITEURL ?>admin/shop-list.php">See All Shops</a></li>
               <li><a href="<?php echo SITEURL ?>admin/add-shop.php">Add New Shop</a></li>
               <li><a href="<?php echo SITEURL ?>admin/manage-shop.php">Manage Shop</a></li>
            </ul>
         </div>
      </div>

      <div class="col-6">
         <div class="setup-item">
            <h5>Brands Setup</h5>

            <ul>
               <li><a href="<?php echo SITEURL ?>admin/brand-list.php">See All Brands</a></li>
               <li><a href="<?php echo SITEURL ?>admin/add-brand.php">Add New Brand</a></li>
               <li><a href="<?php echo SITEURL ?>admin/manage-brand.php">Manage Brands</a></li>
            </ul>
         </div>
      </div>
   </div>

   <hr>
</div>

<?php include "../partials/admin-footer.php"; ?>