<?php
   $caption = "Add Category";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 setup">
   <h4 class="gen_setup">Add New Category</h4>
   <hr>

   <form action="" method="post" style="width: 50%;">
      <div class="row">
         <div class="col-6">
            <div class="form-group">
               <label for="shop">Shop Name</label><br>
               <select name="shop" id="">
               <option value="" disabled>-- Select Shop --</option>

            <?php
               $query = "SELECT * FROM shops WHERE active='Yes'";
               $result = mysqli_query($conn, $query);
               
               if(mysqli_num_rows($result) > 0){
                  while($rows = mysqli_fetch_assoc($result)){
                     $shop_id = $rows['id'];
                     $shop_name = $rows['shop_name'];

               ?>
                  <option value="<?php echo $shop_id; ?>"><?php echo $shop_name ?></option>
               <?php
                  }
               }
            ?>

               </select>
            </div>
         </div>
         
         <div class="col-6">
            <div class="form-group">
               <label for="cat_name">Category Name</label><br>
               <input type="text" name="category" placeholder="Category Name...">
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-6">
            <div class="form-group active">
               <label for="active" class="mr-3">Active</label>
               Yes <input type="radio" name="active" value="Yes"> &nbsp;
               No <input type="radio" name="active" value="No">
            </div>
         </div>
      </div>

      <input type="submit" name="add_category" id="add_prod" value="Add Category">
   </form>

<?php
   if(isset($_POST['add_category'])){
      // get form data
      $catname = $_POST['category'];
      $shop_id = $_POST['shop'];

      if(isset($_POST['active'])){
         $active = $_POST['active'];
      }
      else{
         $active = "Yes";
      }

      $sql = "INSERT INTO category SET
         shop_id = $shop_id,
         cat_name = '$catname',
         active = '$active'
      ";

      $res = mysqli_query($conn, $sql);

      if($res==true){
         $_SESSION['add-cat'] = "New Category Successfully Added!";
         echo "<script>location.href='category-list.php'</script>";
      }
   }
?>
</div>

<?php include "../partials/admin-footer.php"; ?>