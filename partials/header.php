<?php
 include "../config/constants.php"; 
 include "../config/session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title><?= $caption; ?> | Shopping</title>

   <link rel="shortcut icon" href="../images/shopmole-logo3.png" type="image/x-icon">

   <!-- Font awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Slick CSS Link -->
   <link rel="stylesheet" href="../css/slick.css">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <!-- CSS Styling -->
   <link rel="stylesheet" href="../css/styles.css">

   <script type="text/javascript">
      // Get states list of a selected country from dropdown
      function getStates(str) {
         if(str == ""){
            return;
         }
         else{
            xhr = new XMLHttpRequest();
            xhr.onload = function(){
               if(this.status == 200){
                  document.getElementById("state").innerHTML = this.responseText;
               }
            }
            xhr.open("GET", "getStates.php?q="+str, true);
            xhr.send();
         }
      }
      
      // Compute cart item qty, sub-total and net total
      function computeCart(event, qty, prodID, userID) {
         // event.preventDefault();
         var form = document.querySelector(".cart-qty form");

         xhr = new XMLHttpRequest();
         xhr.onload = function(){
            if(this.status == 200){
               if(this.responseText == "success"){
                  location.href="cart.php";
               }
            }
         }
         xhr.open("POST", "calc-cart.php?qty="+qty+"&prod_id="+prodID+"&user_id="+userID, true);
         var formData = new FormData(form);
         xhr.send(formData);
      }

      // Search product by name to edit in admin folder
      function searchProd(event){
         var searchInput = document.querySelector('#main-search input');
         
         if (searchInput.value.trim() == ""){
            event.preventDefault();
         }
         searchInput.value = searchInput.value;
      }

      // Update/Edit customer's address in customer folder
      function updateAddr(event){
         event.preventDefault();

         var form = document.querySelector(".edit-account .main form");

         xhr = new XMLHttpRequest();
         xhr.onload = function(){
            if(this.status == 200){
               if(this.responseText == "success"){
                  document.getElementById("upd-message").innerHTML = "Address Updated Successfully";
               }
               else{
                  document.getElementById("upd-message").innerHTML = "Failed to update address";
               }
            }
         }
         xhr.open("POST", "edit-addr.php", true);

         var formData = new FormData(form);
         xhr.send(formData);
      }
      
   </script>
</head>

<body>

<!-- header section start -->
<header>
   <div class="brand">     
      <a href="<?= SITEURL ?>user/index.php" class="logo"><span class="brand_name"><span style="color:#FFC107">Shop</span>Mole</span>
         <img src="../images/shopmole-logo3.png" width="40px" height="40px" style="margin-left:5px; border-radius:5px">
      </a>

      <i class="fas fa-bars d-none"></i>
   </div>

   <form action="<?php echo SITEURL ?>user/product-search.php" method="post" id="main-search">
      <i class="fas fa-search"></i>
      <input type="search" name="main-search" value="" placeholder="Search Products, Brands and Categories...">
      <button onclick="searchProd(event)" type="submit" name="search_app">Search</button>
   </form>

   <div class="nav-item">
      <div class="icons">
         <i class="fas fa-bars" id="menu-bar"></i>
         <i class="fas fa-search" id="search-icon"></i>
   
         <span>
            <a href="<?php echo SITEURL; ?>user/cart.php">
               <img src="../images/jumia.png" width="35px">
               <div class="cart-count">
                  <?php
                     if(!isset($id)){

                     }
                     else{
                        $query = "SELECT user_id FROM cart WHERE user_id=$id";
                        $result = mysqli_query($conn, $query);
                        echo $count = mysqli_num_rows($result);
                     }
                  ?>
               </div>
            </a>Cart
         </span>
      </div>

      <div class="user-account">
         <div class="account">
            <div class="user-icon">
            
            <?php
               if(isset($_SESSION['id'])){
            ?>
               <i class="fas fa-circle"></i>
            <?php
               }
            else{
            ?>
               <i class="fas fa-circle d-none"></i>
            <?php
            }
            ?>

               
               <i class="far fa-user"></i>
            </div>

            <div class="myAccount">
               <?php
                  if(isset($_SESSION['id'])){
                     $sql = "SELECT firstname FROM customers where id='$id'";
                     $res = mysqli_query($conn, $sql);
                     $row = mysqli_fetch_assoc($res);
                        $firstname = $row['firstname'];

                     echo "Hi " . $firstname;
                  }
                  else{
                     echo "Account";
                  }
               ?> 

               <i class="fas fa-chevron-down"></i>
            </div>

         </div>

         <!-- signout button -->
      <?php
            if(isset($_SESSION['id'])){
         ?>
            <div class="user-dropdown logged-out d-none">
               <ul>
                  <li>
                     <a href="<?php echo SITEURL; ?>customer/my-account.php">
                        <span class="dropdown-icon"><i class="far fa-user"></i></span>
                        <span class="dropdown-text">my account</span>
                     </a>
                  </li>

                  <li>
                     <a href="<?php echo SITEURL; ?>customer/order.php">
                        <span class="dropdown-icon"><i class="fas fa-baby-carriage"></i></span>
                        <span class="dropdown-text">orders</span>
                     </a>
                  </li>

                  <li>
                     <a href="<?php echo SITEURL; ?>customer/inbox.php">
                        <span class="dropdown-icon"><i class="fas fa-envelope-open-text"></i></span>
                        <span class="dropdown-text">inbox</span>
                     </a>
                  </li>

                  <li>
                     <a href="<?php echo SITEURL; ?>customer/saved-item.php">
                        <span class="dropdown-icon"><i class="far fa-heart"></i></span>
                        <span class="dropdown-text">saved items</span>
                     </a>
                  </li>

                  <li>
                     <a href="<?php echo SITEURL; ?>user/checkout.php">
                        <span class="dropdown-icon"><i class="fas fa-clipboard-check"></i></span>
                        <span class="dropdown-text">checked out</span>
                     </a>
                  </li>

                  <hr>

                  <li>
                     <a href="<?php echo SITEURL; ?>logout.php" class="dropdown-text"><button>logout</button>
                     </a>
                  </li>
               </ul>
            </div>
         <?php
            }
            else{
         ?>
            <div class="user-dropdown sign-in d-none">
               <ul>
                  <li>
                     <a href="<?php echo SITEURL; ?>customer/login.php">
                        <span class="signin-text"><button>sign in</button></span>
                     </a>
                  </li>
                  <hr>
                  <li>
                     <a href="<?php echo SITEURL; ?>customer/my-account.php">
                        <span class="signin-icon"><i class="far fa-user"></i></span>
                        <span class="signin-text">my account</span>
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo SITEURL; ?>customer/order.php">
                        <span class="signin-icon"><i class="fas fa-baby-carriage"></i></span>
                        <span class="signin-text">orders</span>
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo SITEURL; ?>customer/saved-item.php">
                        <span class="signin-icon"><i class="far fa-heart"></i></span>
                        <span class="signin-text">saved items</span>
                     </a>
                  </li>
               </ul>
            </div>
         <?php
            }
      ?>
 
      </div>
   </div>
</header>

<!-- header section ends -->

<!-- search form -->
<form action="" id="search-form">
   <input type="search" name="search" id="search-box" placeholder="Search Products..." autocomplete="off">
   <label for="search-box" class="fas fa-search"></label>
   <i class="fas fa-times" id="close"></i>
</form>

<div class="myContainer">

   <?php //Search product in application
      if(isset($_POST['search_app'])){
         $_SESSION['search-app'] = $_POST['main-search'];
      }
   ?>


<!-- Live Chat Window -->
<section class="chat_area">

</section>


<!-- Check if a user is logged or not to display chat button -->
<?php
   if(isset($_SESSION['id'])){
      ?>
      <div class="open_chat">
         <i class="fas fa-envelope"></i>
         <span>Live Chat</span>
      </div>

      <!-- Users selection window -->
      <div class="chat_users d-none">
         <div class="header">
            <form action="" method="GET">
               <div class="labl">
                  <label for="search_user">Search User:</label>
                  <i class="fas fa-minus" id="close_users_chat"></i>
               </div>
               <input type="search" name="user" class="" placeholder="Type user's name...">
               <button onclick="searchUser(event)" type="submit"><i class="fas fa-search"></i></button>
            </form>
         </div>

         <div class="users_list">
            <h4>Users List</h4>
            <div class="users">
               <!-- Displays from ajax/javascript chat-users.php file -->
            </div>
         </div>
      </div>
   <?php
   }
?>


<!-- update orders status and send mail to customer -->
<?php include "../partials/status-update.php"; ?>