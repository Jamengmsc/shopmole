<?php
   $caption = "Homepage";
   include "../partials/header.php"; 
 ?>

   <!-- home section start -->
   <section class="home" id="home">
      <div class="categoryGroup">
         <ul>
            <li>
               <span class="title">Explore Category</span>
            </li>

            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-apple-alt"></i></span>
                  <span class="title">supermarket</span>
               </a>
            </li>

            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-mobile"></i></span>
                  <span class="title">phones & tablets</span>
               </a>
            </li>

            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-laptop"></i></span>
                  <span class="title">laptops & TVs</span>
               </a>
            </li>
            
            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-tshirt"></i></span>
                  <span class="title">fashion</span>
               </a>
            </li>
            
            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-gamepad"></i></span>
                  <span class="title">food & snacks</span>
               </a>
            </li>
            
            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-user-md"></i></span>
                  <span class="title">health & beauty</span>
               </a>
            </li>
            
            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-baby-carriage"></i></span>
                  <span class="title">baby products</span>
               </a>
            </li>
            
            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-temperature-high"></i></span>
                  <span class="title">air conitioners</span>
               </a>
            </li>
            
            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-headphones-alt"></i></span>
                  <span class="title">electronics</span>
               </a>
            </li>
            
            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-tractor"></i></span>
                  <span class="title">machineries & equipment</span>
               </a>
            </li>
            
            <li>
               <a href="#">
                  <span class="icon"><i class="fas fa-tags"></i></span>
                  <span class="title">other categories</span>
               </a>
            </li>
         </ul>
      </div>

      <div class="home-slide">
         <img src="../images/tech-black-friday.jpg">
         <!-- <img src="../images/tech-black-friday.jpg" alt=""> -->
         <!-- <img src="../images/main-advert.jpg" alt=""> -->
      </div>

      <div class="advert">
         <div class="second"><img src="../images/advert1.jpg"></div>
         <div class="first"><img src="../images/food-advert2.jpg"></div>
      </div>
   </section>
   <!-- home section end -->

   <section class="warehouses-wrap">
      <a href="#">
         <div class="warehouse">
            <span><i class="fas fa-utensils"></i></span>
            <div class="text">our foods</div>
         </div>
      </a>
      
      <a href="#">
         <div class="warehouse">
            <span><i class="fas fa-tractor"></i></span>
            <div class="text">machines & tools</div>
         </div>
      </a>

      <a href="#">
         <div class="warehouse">
            <span><i class="fas fa-headphones-alt"></i></span>
            <div class="text">phones & tablets</div>
         </div>
      </a>

      <a href="#">
         <div class="warehouse">
            <span><i class="fab fa-shopify"></i></span>
            <div class="text">official store</div>
         </div> 
      </a>  
   </section>

   <!-- top selling item starts here -->
   <?php include "../partials/top-selling.php"; ?>
   <!-- top selling items section ends here -->

   <!-- advertisement area -->
   <section class="advertise">
      <div class="advert-box">
         <h4>Trendy Smartphone Accessories</h4>
         <img src="../images/main-advert2-1.jpg" width="100%" alt="">
      </div>
      <div class="advert-box" style="text-align:center">
         <h1 style="margin-top:75px; font-weight:bold;">Advertise Here</h1>
      </div>
   </section>
   <!-- end advertisement area -->

   <!-- recently viewed items -->
   <?php include "../partials/views-recent.php"; ?>
   <!-- recently viewed items ends here -->

<?php include "../partials/footer.php"; ?>