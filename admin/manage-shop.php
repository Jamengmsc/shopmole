<?php
   $caption = "Manage Shops";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 setup manage_prod">
   <h4 class="gen_setup">Manage Shop</h4>
   <hr>

   <form action="" method="post">
      <div class="row">
         <div class="col-6">
            <div class="form-group">
               <label for="shop">Shop Name</label><br>
               <select name="shop" id="">

            <?php
               $sql = "SELECT * FROM shops";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);

               if($count>0){
                  while($rows = mysqli_fetch_assoc($res)){
                     $shop_id = $rows['id'];
                     $shop_name = $rows['shop_name'];

                  ?>
                     <option value="<?php echo $shop_id; ?>"><?php echo $shop_name; ?></option>
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
               <label for="rename-shop">Rename Shop</label>
               <input type="text" name="rename" placeholder="Rename Shop...">
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
      
      <input type="submit" name="update" id="upd_btn" value="Update Shop">
      <input type="submit" name="delete" id="del_btn" value="Delete Shop">

   </form>

<?php
   if(isset($_POST['update'])){
      // get form data
      $id = $_POST['shop'];
      $rename_shop = $_POST['rename'];

      if(isset($_POST['active'])){
         $active = $_POST['active'];
      }
      else{
         $active = "Yes";
      }

      $sql1 = "UPDATE shops SET
         shop_name = '$rename_shop',
         active = '$active'

       WHERE id=$id";

      $res1 = mysqli_query($conn, $sql1);
      
      if($res1==true){
         $_SESSION['upd-shop'] = "<div class='text-success mb-2'>Shop Successfully Updated!</div>";
         echo "<script>location.href='shop-list.php'</script>";
      }
   }

?>
   
</div>

<?php include "../partials/admin-footer.php"; ?>