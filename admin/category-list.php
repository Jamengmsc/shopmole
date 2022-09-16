<?php
   $caption = "Category List";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 all-categories">
   <div class="d-flex justify-content-between align-items-center mt-3">
      <h4 class="gen_setup p-0">Category List</h4>
      <a href="<?php echo SITEURL ?>admin/add-category.php" class="text-info text-decoration-none">Add New Category</a>
   </div>
   <hr>

<?php
   if(isset($_SESSION['add-cat'])){
      echo $_SESSION['add-cat'];
      unset($_SESSION['add-cat']);
   }
?>

   <table>
      <tr>
         <th>S/N</th>
         <th>Category Name</th>
         <th>Shop</th>
         <th>Active</th>
      </tr>

<?php
   $sql = "SELECT * FROM category order by cat_name asc";
   $res = mysqli_query($conn, $sql);
   $count = mysqli_num_rows($res);

   if($count > 0){
      $sn = 1;
      while($rows = mysqli_fetch_assoc($res)){
         $cat_id = $rows['id'];
         $cat_name = $rows['cat_name'];
         $active = $rows['active'];
         $shop_id = $rows['shop_id'];

      ?>
         <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $cat_name; ?></td>

            <td>
               <?php
                  $sql1 = "SELECT shop_name FROM shops WHERE id=$shop_id";
                  $res1 = mysqli_query($conn, $sql1);
                  if(mysqli_num_rows($res1) == 1){
                     echo mysqli_fetch_assoc($res1)['shop_name'];
                  }
               ?>
            </td>
            
            <td><?php echo $active; ?></td>
         </tr>
      <?php
      }
   }
?>

   </table>   
</div>

<?php include "../partials/admin-footer.php"; ?>