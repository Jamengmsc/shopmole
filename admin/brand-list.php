<?php
   $caption = "Brands List";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 all-categories">
   <div class="d-flex justify-content-between align-items-center mt-3">
      <h4 class="gen_setup p-0">Brands List</h4>
      <a href="<?php echo SITEURL ?>admin/add-brand.php" class="text-info text-decoration-none">Add New Brand</a>
   </div>

   <hr>

<?php
   if(isset($_SESSION['add-brand'])){
      echo $_SESSION['add-brand'];
      unset($_SESSION['add-brand']);
   }

   if(isset($_SESSION['upd-brand'])){
      echo $_SESSION['upd-brand'];
      unset($_SESSION['upd-brand']);
   }
?>

   <table>
      <tr>
         <th>S/N</th>
         <th>Brand Name</th>
         <th>Category</th>
         <th>Active</th>
      </tr>

   <?php
      $sql = "SELECT * FROM brands";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if($count>0){
         $sn = 1;

         while($rows = mysqli_fetch_assoc($res)){
            $cat_id = $rows['cat_id'];
      ?>
         <tr>
            <td><?= $rows['id'] ?></td>
            <td><?= $rows['brand_name'] ?></td>
            <td>
               <?php
                  $query = "SELECT cat_name FROM category WHERE id=$cat_id";
                  $result = mysqli_query($conn, $query);

                  if(mysqli_num_rows($result)==1){
                     echo $cat_name = mysqli_fetch_assoc($result)['cat_name'];
                  }
               ?>
            </td>
            <td><?= $rows['active'] ?></td>
         </tr>
      <?php
         }
      }
   ?>
      
   </table>   
</div>

<?php include "../partials/admin-footer.php"; ?>