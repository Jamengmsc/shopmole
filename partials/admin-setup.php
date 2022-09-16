<?php include "../config/constants.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title><?= $caption ?> - Admin</title>

   <link rel="shortcut icon" href="../images/shopmole-logo3.png" type="image/x-icon">

  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- Font awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Bootstrap CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- CSS Styling -->
<link rel="stylesheet" href="../css/admin.css">

   <script type="text/javascript">
      // Display product details on selection from dropdown in manage-product.php
      function getProductDetails(str){
         if(str == ""){
            return
         }
         else{
            xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function (){
               if(this.readyState == 4 && this.status == 200){
                  document.getElementById('showForm').innerHTML = this.responseText;
               }
            }
         }
         xhr.open("GET", "get-product.php?q=" + str, true);
         xhr.send();
      }

      // Load categories belonging to selected shop(store)
      function manageCat(str){
         if(str == ""){
            return
         }
         else{
            xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function (){
               if(this.readyState == 4 && this.status == 200){
                  document.getElementById('update-product').innerHTML = this.responseText;
               }
            }
         }
         xhr.open("GET", "load-category.php?shop_id=" + str, true);
         xhr.send();
      }

      // Load categories belonging to selected shop(store)
      function loadCategory(str){
         if(str == ""){
            return
         }
         else{
            xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function (){
               if(this.readyState == 4 && this.status == 200){
                  document.getElementById('shop_category').innerHTML = this.responseText;
                  console.log(this.responseText);
               }
            }
         }
         xhr.open("GET", "load-category.php?q=" + str, true);
         xhr.send();
      }

      // Load brands belonging to selected category
      function loadBrand(str){
         if(str == ""){
            return
         }
         else{
            xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function (){
               if(this.readyState == 4 && this.status == 200){
                  document.getElementById('cat_brand').innerHTML = this.responseText;
                  console.log(this.responseText);
               }
            }
         }
         xhr.open("GET", "load-brand.php?q=" + str, true);
         xhr.send();
      }

      // Load products searched for on manage-products.php file
      function loadProd(event){
         event.preventDefault();

         var inputField = document.getElementById("inputField");

         if(inputField.value.trim() == ""){
            return false
         }
         
         xhr = new XMLHttpRequest();
         xhr.onload = function() {
            if(this.status == 200){
               document.getElementById("loaded_prod").innerHTML = this.responseText;
               inputField.value = "";
               inputField.focus();
            }
            else{
               alert("something went wrong");
            }
         }
         xhr.open("GET", "load-products.php?search=" + inputField.value, true);
         xhr.send();
      }

      // Update product
      function updateProd(event, prodID){
         event.preventDefault();

         confirm("Are you sure you want to update this product?");

         var form = document.querySelector(".prod_upd_form");

         xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function (){
               if(this.readyState == 4 && this.status == 200){
                  // console.log(this.responseText);
                  if(this.responseText == "success"){
                     document.getElementById('upd_prod_msg').innerHTML = "Product Updated Successfully";
                  }
               }
            }
         xhr.open("POST", "update-product.php?prod_id=" + prodID, true);

         var formData = new FormData(form);
         xhr.send(formData);
      }
      
   </script>

</head>
<body>
   
<div class="mycontainer">
   <div class="navigation">
      <ul>
         <li>
            <a class="d-flex align-items-center ml-1 mt-2" href="<?php echo SITEURL ?>user/index.php">
               <span class="icon"><img src="../images/shopmole-logo4.png" style="border-radius:10px" width="40px"></span>
               <span class="title mt-3 ml-n2"><h4>E-Shopping</h4></span>
            </a>
         </li>

         <li>
            <a href="<?php echo SITEURL ?>admin/index.php">
               <span class="title">dashboard</span>
            </a>
         </li>

         <li>
            <a href="<?php echo SITEURL ?>admin/products-list.php">
               <span class="icon"><i class="fas fa-layer-group"></i></span>
               <span class="title">Products</span>
            <?php
               $sql1 = "SELECT * FROM products";
               $res1 = mysqli_query($conn, $sql1);
               $count1 = mysqli_num_rows($res1);
            ?>
               <span class="notification"><span><?= $count1 ?></span></span>
            </a>
         </li>

         <li>
            <a href="<?php echo SITEURL ?>admin/active-orders.php">
               <span class="icon"><i class="fas fa-shopping-basket"></i></span>
            <?php
               $confirmed_order = "SELECT order_id FROM orders WHERE active=1 GROUP BY order_id";
               $confirmed_order_res = mysqli_query($conn, $confirmed_order);
               $confirmed_orders = mysqli_num_rows($confirmed_order_res);
            ?>
               <span class="title">Active Orders</span>
               <span class="notification"><span><?php echo $confirmed_orders ?></span></span>
            </a>
         </li>

         <li>
            <a href="<?php echo SITEURL ?>admin/pending-order.php">
               <span class="icon"><i class="fas fa-baby-carriage"></i></span>
            <?php
               $pending_order = "SELECT order_id FROM orders WHERE order_status='Pending' GROUP BY order_id";

               $pending_order_res = mysqli_query($conn, $pending_order);
               $count_orders = mysqli_num_rows($pending_order_res);
            ?>
               <span class="title">pending orders</span>
               <span class="notification"><span><?= $count_orders ?></span></span>
            </a>
         </li>

         <li>
            <a href="#">
               <span class="icon"><i class="fas fa-envelope"></i></span>
               <span class="title">message</span>
               <span class="notification"><span>19</span></span>
            </a>
         </li>

         <li>
            <a href="<?php echo SITEURL ?>admin/customers-list.php">
               <span class="icon"><i class="fas fa-user-friends"></i></span>
               <span class="title">customers</span>
            <?php
               $sql = "SELECT * FROM customers";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);
            ?>
               <span class="notification"><span><?= $count; ?></span></span>
            </a>
         </li>

         <li>
            <a href="#">
               <span class="icon"><i class="fa fa-question-circle"></i></span>
               <span class="title">help</span>
            </a>
         </li>

         <li class="setup">
            <a href="<?php echo SITEURL ?>admin/setup.php">
               <span class="icon"><i class="fas fa-cogs"></i></span>
               <span class="title">Setup</span>
            </a>
         </li>


         <div class="d-flex" style="margin:140px 0 0 10px">
            <img src="../images/shopmole-logo4.png" style="border-radius:10px" width="45px" alt="">
            <div class="text-light align-self-end ml-2 mb-1">Your One-Stop Shop</div>
         </div>
      </ul>

   </div>

   <!-- main section starts -->
   <div class="main">
      <div class="topbar">
         <div class="toggle" onclick="toggleMenu();">
            <i class="fas fa-bars"></i>
         </div>

         <div class="search">
            <i class="fa fa-search"></i>
            
            <input type="text" placeholder="Search here...">
            <input type="submit" name="submit" value="Search">
         </div>

         <div class="user-profile">
            <div class="personel">
               <div class="admin-name">akan johnson</div>
               <div class="administrator">Administrator</div>
            </div>
            <div class="user">
               <img src="../images/customers/Customer_950.jpg" alt="">
            </div>
         </div>
   </div>
   <!-- main section ends -->