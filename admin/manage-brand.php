<?php
   $caption = "Manage Brands";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 setup manage_prod">
   <h4 class="gen_setup">Manage Brand</h4>
   <hr>

   <form action="" method="post">
      <div class="row">
         <div class="col-6">
            <div class="form-group">
               <label for="brand">Brand Name</label><br>
               <select name="brand" id="">
                  <option value="select" selected>--Select Brand--</option>

               <?php
                  $sql = "SELECT * FROM brands WHERE active='Yes'";
                  $res = mysqli_query($conn, $sql);
                  $count = mysqli_num_rows($res);

                  if($count>0){
                     while($rows = mysqli_fetch_assoc($res)){
                  ?>
                     <option value="<?= $rows['id'] ?>"><?= $rows['brand_name'] ?></option>
                  <?php
                     }
                  }
               ?>
                  
               </select>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-6">
            <div class="form-group">
               <label for="brand">Rename Brand</label>
               <input type="text" name="rename" placeholder="Rename Brand...">
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

      <br>
      
      <input type="submit" name="update" id="upd_btn" value="Update Brand">
      <input type="submit" name="delete" id="del_btn" value="Delete Brand">
   </form>

   <?php
   if(isset($_POST['update'])){
      // get form data
      $id = $_POST['brand'];
      $rename_brand = $_POST['rename'];

      if(isset($_POST['active'])){
         $active = $_POST['active'];
      }
      else{
         $active = "Yes";
      }

      $sql1 = "UPDATE brands SET
         brand_name = '$rename_brand',
         active = '$active'

       WHERE id=$id";

      $res1 = mysqli_query($conn, $sql1);
      
      if($res1==true){
         $_SESSION['upd-brand'] = "<div class='text-success mb-2'>Brand Successfully Updated!</div>";
         echo "<script>location.href='brand-list.php'</script>";
      }
   }

?>
   
</div>

<?php include "../partials/admin-footer.php"; ?>