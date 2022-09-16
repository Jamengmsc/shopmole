<?php
   $caption = "New Address";
   include "../partials/header.php";
   include "../config/auth.php";
?>


<!-- new address starts -->
<section class="user-account edit-account" id="edit-account">
   <div class="wrapper">
      <?php include "../partials/sidemenu.php"; //Sidemenu for customers' page ?>

      <div class="main">
         <h5><i class="fas fa-arrow-left"></i> add new address</h5>

         <form action="" method="POST">
            <div class="edit-input">
               <div class="detail1">
                  <div class="form-group">
                     <label for="firstname">first name</label><br>
                     <input type="text" name="firstname" id="firstname" value="AKAN">
                  </div>
                  <div class="form-group">
                     <label for="mobile">Phone Number (optional)</label><br>
                     <input type="text" name="mobile" id="mobile" value="+234 9060277675">
                  </div>
               </div>

               <div class="detail2">
                  <div class="form-group">
                     <label for="lastname">last name</label><br>
                     <input type="text" name="lastname" id="lastname" value="JOHNSON">
                  </div>
                  
                  <div class="form-group">
                     <label for="ad-mobile">additional Phone Number</label><br>
                     <input type="text" name="ad-mobile" id="ad-mobile" value="+234 8171668988">
                  </div>
               </div>
            </div>

            <div class="form-group">
               <label for="address">address</label><br>
               <input type="text" name="address" id="address" value="" placeholder="Address">
            </div>

            <div class="form-group">
               <label for="ad-address">additional information</label><br>
               <input type="text" name="ad-address" id="ad-address" value="" placeholder="Addition information">
            </div>

            <div class="detail3">
               <div class="form-group">
                  <label for="region">region</label><br>
                  <select name="region" id="myregion">
                     <option value="select" disabled selected>Please select</option>
                     <option value="lagos">Lagos</option>
                     <option value="abuja">Abuja</option>
                     <option value="uyo">Uyo</option>
                     <option value="ogun">Ogun</option>
                  </select>
               </div>
               
               <div class="form-group">
                  <label for="city">city</label><br>
                  <select name="city" id="mycity" disabled>
                     <option value="select" disabled selected>Please select</option>
                     <option value="anthony">Anthony</option>
                     <option value="gbagada">Gbagada</option>
                  </select>
               </div>
            </div>

            <div class="set-default">
               <input type="checkbox" name="" id="">
               <label for="default-address">set as default address</label>
            </div>

            <input type="submit" name="submit" id="submit" value="SAVE">
         </form>
         
      </div>
</section>
<!-- user account details ends -->


<?php include "../partials/footer.php"; ?>