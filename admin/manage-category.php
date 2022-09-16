<?php
   $caption = "Manage Categories";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 setup manage_prod">
   <h4 class="gen_setup">Manage Category</h4>
   <hr>

   <form action="" method="post">
      <div class="row">
         <div class="col-4">
            <div class="form-group">
               <label for="shop">Shop Name</label><br>
               <select name="shop" id="manage_cat" onchange="manageCat(this.value)">
                  <option value="select">-Select Shop-</option>
                     <?php
                        $sql = "SELECT * FROM shops WHERE active='Yes'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);

                        if($count>0){
                           while($rows = mysqli_fetch_assoc($res)){
                              $shop_id = $rows['id'];
                              $shop_name = $rows['shop_name'];
                        
                              echo "<option value=" . $shop_id .">" . $shop_name ."</option>";
                           }
                        }
                     ?>
               </select>
            </div>
         </div>

         <div class="col-4">
            <div class="form-group">
               <label for="cat_name">Category Name</label><br>
               <select name="category" id="update-product">
                  <option value="select">-Select Category-</option>
                  <!-- option values from ajax and php in load-category.php -->
               </select>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-8">
            <div class="form-group">
               <label for="rename_cat">Rename Category</label>
               <input type="text" name="rename_cat" placeholder="Rename Cateogry...">
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-6">
            <div class="form-group active">
               <label for="active" class="mr-3">Active</label>
               Yes <input type="radio" name="active" value="Yes" checked> &nbsp;
               No <input type="radio" name="active" value="No">
            </div>
         </div>
      </div>
      
      <input type="submit" name="update" id="upd_btn" value="Update Category">
      <input type="submit" name="delete" id="del_btn" value="Delete Category">

   </form>

<?php
   if(isset($_POST['update'])){
      $sel_cat_id = $_POST['category'];
      $cat_name = $_POST['rename_cat'];

      $query = "UPDATE category SET
         cat_name = '$cat_name'
         where id=$sel_cat_id
      ";

      $result = mysqli_query($conn, $query);
      if($result==true){
         echo "<div class='ml-4 text-success'>Category Name has been changed to <span class='text-dark font-weight-bold'>" . $cat_name . "</span></div>";
      }
   }
?>
   
</div>

<?php include "../partials/admin-footer.php"; ?>