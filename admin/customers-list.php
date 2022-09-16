<?php
   $caption = "Customers List";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 all-products">
   
   <div class="d-flex justify-content-between align-items-center">
      <h4 class="gen_setup p-0 mt-3">Customers List</h4>

      <?php
         if(isset($_SESSION['upd-customer'])){
            echo $_SESSION['upd-customer'];
            unset($_SESSION['upd-customer']);
         }
      ?>
   </div>
   
   <hr>

   <table class="">
      <!-- <thead> -->
      <tr>
         <th>S/N</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Gender</th>
         <th>Address</th>
         <th>Email</th>
         <th>Phone</th>
         <th>Image</th>
         <th>Active</th>
         <th colspan="2">Action</th>
      </tr>
      <!-- </thead> -->

   <?php
      $sql = "SELECT * FROM customers ORDER BY firstname ASC";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      
      if($count>0){
         $sn = 1;

         while($rows = mysqli_fetch_assoc($res)){
            
      ?>
         <tr>
         <td><?= $sn++ ?></td>
         <td class="font-weight-bold"><a href="<?php SITEURL ?>admin/view-customer.php?cust_id=<?php echo $rows['id'] ?>" class="text-dark"><?= $rows['firstname'] ?></a></td>
         <td><?= $rows['lastname']; ?></td>
         <td><?= $rows['gender']; ?></td>
         <td><?= $rows['address']; ?></td>
         <td><?= $rows['email']; ?></td>
         <td><?= $rows['mobile']; ?></td>
         <td>
            <div class="user-img">
         <?php
            if($rows['image_url'] != ""){
         ?>
            <img src="../images/customers/<?= $rows['image_url'] ?>" class="img-fluid" width="50px" alt="">
         <?php
            }
            else{
               echo "No Image";
            }
         ?>
            </div>
         </td>
         <td><?php echo $rows['active'] ?></td>
         <td>
            <a href="<?php echo SITEURL ?>admin/edit-customer.php?cust_id=<?= $rows['id']; ?>" class="border-right pr-2">Edit</a>
         </td>
         <td>
            <a onclick="return confirm('Are you sure you want to delete customer?')" href="<?php echo SITEURL ?>admin/delete-customer.php?cust_id=<?= $rows['id']; ?>&image_name=<?= $rows['image_url']; ?>" class="pl-2">Delete</a>
         </td>
      </tr>
      <?php
         }
      }
   ?>

   </table>
</div>

<?php include "../partials/admin-footer.php"; ?>