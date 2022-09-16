<?php
   $caption = "Shops List";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 all-categories">
   <div class="d-flex justify-content-between align-items-center">
      <h4 class="gen_setup p-0">Shops List</h4>
      <a href="<?php echo SITEURL ?>admin/add-shop.php" class="text-info text-decoration-none">Add New Shop</a>
   </div>
   <hr>

<?php
   if(isset($_SESSION['add-shop'])){
      echo $_SESSION['add-shop'];
      unset($_SESSION['add-shop']);
   }

   if(isset($_SESSION['add-cat'])){
      echo $_SESSION['add-cat'];
      unset($_SESSION['add-cat']);
   }
?>

   <table>
      <tr>
         <th>S/N</th>
         <th>Shop Name</th>
         <th>Active</th>
      </tr>
<?php
   $sql = "SELECT * FROM shops";
   $res = mysqli_query($conn, $sql);
   $count = mysqli_num_rows($res);

   if($count>0){
      $sn = 1;

      while($row = mysqli_fetch_assoc($res)){
         $shop_id = $row['id'];
         $shop_name = $row['shop_name'];
         $active = $row['active'];

      ?>
         <tr>
            <td><?= $sn++ ?></td>
            <td><?= $shop_name ?></td>
            <td><?= $active ?></td>
         </tr>
      <?php
      }
   }
?>
      
   </table>   
</div>

<?php include "../partials/admin-footer.php"; ?>