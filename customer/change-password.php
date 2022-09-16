<?php
   $caption = "Change Password";
   include "../partials/header.php";
   include "../config/auth.php";
?>


<!-- change password starts -->
   <section class="user-account edit-account" id="edit-account">
      <div class="wrapper">
         <?php include "../partials/sidemenu.php"; //Sidemenu for customers' page ?>
   
         <div class="main">
            <h5>change password</h5>

            <form action="" method="POST">
               <div class="edit-input">
                  <div class="change-password">
                     <div class="form-group">
                        <input type="password" name="current-pwd" id="current-pwd" placeholder="Current Password">
                        <i class="fas fa-eye-slash"></i>
                     </div>

                     <div class="form-group">
                        <input type="password" name="new-pwd" id="new-pwd" placeholder="new Password">
                        <i class="fas fa-eye-slash"></i>
                     </div>

                     <div class="form-group">
                        <input type="password" name="email" id="email" placeholder="retype new password">
                        <i class="fas fa-eye-slash"></i>
                     </div>
                  </div>
   
                  <div class="detail2"></div>

               <input type="submit" name="submit" id="submit" value="SAVE">
            </form>
           
         </div>
   </section>
<!-- change password ends -->


<?php include "../partials/footer.php"; ?>