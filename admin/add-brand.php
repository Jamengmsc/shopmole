<?php
   $caption = "Add Brand";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 setup">
   <h4 class="gen_setup">Add New Brand</h4>
   <hr>

   <form action="" method="post" style="width: 50%;">
      <div class="row">
         <div class="col-6">
            <div class="form-group">
               <label for="category">Category</label>
               <select name="category" id="">
                  <option value="select" selected>-Select Category-</option>
               
                  <?php
                     $query = "SELECT * FROM category WHERE active='Yes' order by cat_name asc";
                     $result = mysqli_query($conn, $query);

                        if(mysqli_num_rows($result)>0){
                           while($rows = mysqli_fetch_assoc($result)){
                              $cat_id = $rows['id'];
                              $cat_name = $rows['cat_name'];
                        ?>
                           <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                        <?php
                        }
                     }
                  ?>

               </select>
            </div>
         </div>

         <div class="col-6">
            <div class="form-group">
               <label for="cat_name">Brand Name</label><br>
               <input type="text" name="brand" placeholder="Brand Name...">
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

      <input type="submit" name="add_brand" id="add_prod" value="Add Brand">
   </form>

   <?php
      if(isset($_POST['add_brand'])){

         $brand_name = $_POST['brand'];
         $category_id = $_POST['category'];

         if(isset($_POST['active'])){
            $active = $_POST['active'];
         }
         else{
            $active = "Yes";
         }

         $sql = "INSERT INTO brands SET
            cat_id = $category_id,
            brand_name = '$brand_name',
            active = '$active'
         ";

         $res = mysqli_query($conn, $sql);
         if($res==true){
            $_SESSION['add-brand'] = "<div class='mb-3'>Brand Successfully Added</div>";
            echo "<script>location.href='brand-list.php'</script>";
         }
      }
   ?>

</div>

<?php include "../partials/admin-footer.php"; ?>