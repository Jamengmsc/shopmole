<?php
   $caption = "Edit Customer";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 all-products">
   
   <h4 class="gen_setup p-0 mt-3">Update Customer</h4>
   <hr>

   <h5 class="font-weight-bold">Details</h5>

<?php
   if(isset($_GET['cust_id'])){
      $cust_id = $_GET['cust_id']; //Customer ID

      $sql = "SELECT * FROM customers WHERE id=$cust_id";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if($count==1){
         $row = mysqli_fetch_assoc($res);
      }
   }
?>

   <div class="user-upd-wrapper mt-4">
      <form action="" method="post" enctype="multipart/form-data">
         <div class="row">
            <div class="col-6">
               <div class="form-group">
                  <label for="name">First Name</label><br>
                  <input type="text" name="firstname" value="<?= $row['firstname'] ?>">
               </div>
            </div>
            <div class="col-6">
               <div class="form-group">
                  <label for="brand">Last Name</label><br>
                  <input type="text" name="lastname" value="<?= $row['lastname'] ?>">
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col">
               <div class="form-group">
                  <label for="email">Email</label><br>
                  <input type="text" name="email" value="<?= $row['email'] ?>">
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col">
               <div class="form-group">
                  <label for="address">Address</label><br>
                  <textarea name="address" id="" cols="30" rows="1"><?= $row['address'] . ", " . $row['address_add']  ?></textarea>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-4">
               <div class="form-group">
                  <label for="mobile">Phone Number</label><br>
                  <input type="text" name="mobile" value="<?= $row['mobile'] ?>">
               </div>
            </div>
            <div class="col-3">
               <div class="form-group">
                  <label for="gender">Gender</label><br>
                  <input type="text" name="gender" value="<?= $row['gender'] ?>">
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-4">
               <div class="form-group">
                  <label for="country">Country</label><br>
                  <input type="text" name="country" value="<?= $row['country'] ?>">
               </div>
            </div>
            <div class="col-4">
               <div class="form-group">
                  <label for="state">State</label><br>
                  <input type="text" class="text-capitalize" name="state" value="<?= $row['state'] ?>">
               </div>
            </div>
            <div class="col-4">
               <div class="form-group active">
                  <label for="active" class="mr-3">Active</label>
                  Yes <input type="radio" name="active" value="Yes" <?php if($row['active']=="Yes"){ echo "checked"; } ?>> &nbsp;
                  No <input type="radio" name="active" value="No" <?php if($row['active']=="No"){ echo "checked"; } ?>>
               </div>
            </div>
         </div>

         <input type="submit" id="add_prod" name="submit" value="Update Customer">
      </form>

      <div class="disp-img mt-n5">
      <?php
         if($row['image_url'] !=""){
         ?>
            <img src="../images/customers/<?= $row['image_url'] ?>" width="100%" alt="">
         <?php
         }
         else{
            echo "<div class='text-danger font-italic'>No Image!</div>";
         }
      ?>
      </div>
   </div>
</div>

<!-- Edit Customer Status -->
<?php
   
   if(isset($_POST['submit'])){
      // Get customer's active status
      if(isset($_POST['active'])){
         $active = $_POST['active'];
      }

      $query = "UPDATE customers SET
         active = '$active'

       WHERE id=$cust_id";

      $result = mysqli_query($conn, $query);

      if($result==true){
         $_SESSION['upd-customer'] = "Customer Status Updated";
         echo "<script>location.href='customers-list.php'</script>";
      }
   }
?>

<?php include "../partials/admin-footer.php"; ?>