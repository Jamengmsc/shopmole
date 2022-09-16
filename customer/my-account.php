<?php
   $caption = "My Account";
   include "../partials/header.php";
   include "../config/auth.php";
?>

   <!-- My account details starts -->
   <section class="user-account my-account" id="my-account">
      <div class="wrapper">
         <?php include "../partials/sidemenu.php"; //Sidemenu for customers' page ?>
   
         <div class="main">
            <h4>account overview</h4>

            <div class="details">
               <div class="acct-details">
                  <div class="head">
                     <h4>account details</h4>
                     <a href="<?php echo SITEURL ?>customer/edit-account.php"><i class="fas fa-pencil-alt"></i></a>
                  </div>

                  <div class="details-body">
                     <div class="email-acct">
                     <?php
                        $sql = "SELECT * FROM customers WHERE id=$id";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);

                        if($count==1){
                           $row = mysqli_fetch_assoc($res);
                        }
                     ?>
                        <h5 style="border:none; padding:5px 0"><?= $row['firstname'] . " " . $row['lastname'] ?></h5>
                        <p><?= $row['email'] ?></p>
                     </div>

                     <div class="change-pwd" style="margin-bottom:8px">
                        <a href="<?php echo SITEURL; ?>customer/change-password.php">change password</a>
                     </div>
                  </div>
               </div>

               <div class="addr-book">
                  <div class="head">
                     <h4>address book</h4>
                     <a href="<?php echo SITEURL ?>customer/edit-address.php"><i class="fas fa-pencil-alt"></i></a>
                  </div>

                  <p style="text-transform:capitalize">your default shipping address</p>

                  <br><br><br>

                  <div class="user-name"><?= $row['firstname'] . " " . $row['lastname'] ?></div>
                  <div class="user-addr"><?= $row['address'] . ",</br> " . $row['address_add'] ?></div>
                  <div class="user-mobile"><?= $row['mobile'] . " / " . $row['mobile_add'] ?></div>
               </div>
            </div>

            <p style="text-transform:capitalize; padding:10px">put details of user's transactions on this website. will think of what user's details to put...</p>
           
         </div>
   </section>
   <!-- my account details ends here -->

   <!-- top selling item starts here -->
   <?php include "../partials/top-selling.php"; ?>
   <!-- top selling items section ends here -->

   <!-- recently viewed items -->
   <?php include "../partials/views-recent.php"; ?>
   <!-- recently viewed items ends here -->


<?php include "../partials/footer.php"; ?>