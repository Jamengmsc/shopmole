<?php
   $caption = "Manage Products";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 setup manage_prod">
   <div class="d-flex justify-content-between align-items-center">
      <h4 class="gen_setup">Manage Product</h4>
      <div id="upd_prod_msg" class="text-success mt-3 mr-3"></div>
   </div>
   <hr>

   <form action="" method="" class="search-form">
      <span>Search Product:</span> &nbsp;
      <select name="product" id="loaded_prod" onchange="getProductDetails(this.value);">
         <option value="" disabled selected>--Select Product--</option>
      </select>
      
      <input type="search" name="search-item" class="w-25" id="inputField" placeholder="Search a product...">
      <input onclick="loadProd(event)" type="submit" name="submit" value="Search">
   </form>   
   
   <div id="showForm">
      <div class="text-center">
         Search and select a product to display details
      </div>

      <div class="text-center text-success mt-5">
         <?php
            if(isset($_SESSION['prod-updated'])){
               echo $_SESSION['prod-updated'];
               unset($_SESSION['prod-updated']);
            }
         ?>
      </div>
   </div>
   
</div>

<?php include "../partials/admin-footer.php"; ?>