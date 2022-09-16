<?php
   $caption = "Address Book";
   include "../partials/header.php";
   include "../config/auth.php";
?>


<!-- address book starts -->
   <section class="user-account edit-account" id="edit-account">
      <div class="wrapper">
         <?php include "../partials/sidemenu.php"; //Sidemenu for customers' page ?>
   
         <div class="main">
            <div class="addr-book-head">
               <h5>addresses <span>(2)</span></h5>
               <a href="#" class="add-new-addr">add new address</a>
            </div>

            <div class="address-list">
               
            <!-- New address item into the addresses list -->
               <div class="address-item">
                  <div class="user-name">akan johnson</div>
                  <p class="user-address">6, obazur street</p>
                  <p class="ad-address">sawmill, gbagada, lagos</p>
                  <p class="city">gbagada, lagos</p>
                  <p class="mobile">+234 9060277675 / +2348171668988</p>

                  <div class="default-addr">default address</div>

                  <div class="btnGroup">
                     <div class="setDefault"><button type="submit">set as default</button></div>
                     <div class="edit-delete">
                        <i class="fas fa-pencil-alt"></i>
                        <i class="fas fa-trash"></i>
                     </div>
                  </div>
               </div>
            <!-- new address item ends here -->

            <!-- New address item into the addresses list -->
               <div class="address-item default">
                  <div class="user-name">akan johnson</div>
                  <p class="user-address">296, ikorodu road</p>
                  <p class="ad-address">close to corona schools, anthony</p>
                  <p class="city">anthony, lagos</p>
                  <p class="mobile">+234 9087177826</p>

                  <div class="default-addr">default address</div>

                  <div class="btnGroup">
                     <div class="setDefault"><button type="submit">set as default</button></div>
                     <div class="edit-delete">
                        <a href="#"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#"><i class="fas fa-trash"></i></a>
                     </div>
                  </div>
               </div>
            <!-- new address item ends here -->

            </div>
         </div>
   </section>
<!-- address book ends -->



<?php include "../partials/footer.php"; ?>