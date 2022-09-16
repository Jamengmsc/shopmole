<?php
   $caption = "Inbox Messages";
   include "../partials/header.php";
   include "../config/auth.php";
?>


   <!-- inbox starts -->
   <section class="user-account edit-account" id="edit-account">
      <div class="wrapper">
         <?php include "../partials/sidemenu.php"; //Sidemenu for customers' page ?>

         <div class="main">
            <h5 style="font-size:17px; font-weight:700">Inbox Messages</h5>

            <div class="inbox-messages">

            <?php
               $sql = "SELECT * FROM cust_inbox WHERE user_id=$id";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);

               if($count>0){
                  while($rows = mysqli_fetch_assoc($res)){
                     $order_no = $rows['order_id'];

                  ?>
                     <!-- inbox message item -->
                     <div class="message-item">
                        <div class="message-date">
                           <div class="date">
                              <?php
                                 $date = strtotime($rows['message_date']);
                                 echo $date = date('F d', $date);
                              ?> 
                           <i class="fas fa-circle"></i></div>
                           <a href="<?php echo SITEURL ?>customer/order-details.php?order_id=<?php echo $order_no ?>" class="see-details">see details</a>
                        </div>

                        <div class="message">
                           <h6><?= $rows['order_status'] ?></h6>
                           <p><?= $rows['mess'] ?></p>
                        </div>
                  <?php

                     $query = "SELECT prod_id FROM orders WHERE order_id=$order_no AND active = 1";
                     $result = mysqli_query($conn, $query);
                     $count_order = mysqli_num_rows($result); 

                     if($count_order>0){
                        while($row = mysqli_fetch_assoc($result)){
                           $prod_id = $row['prod_id'];

                           $get_prod = "SELECT * FROM products WHERE prod_id=$prod_id";
                           $get_prod_res = mysqli_query($conn, $get_prod);
                           
                           if(mysqli_num_rows($get_prod_res)==1){
                              $prod_row = mysqli_fetch_assoc($get_prod_res);
                              ?>
                                 <div class="item-of-message" style="margin-bottom:7px">
                                    <div class="item-image">
                                 <?php
                                    if($prod_row['image_name'] !=""){
                                 ?>
                                    <img src="../images/products/<?= $prod_row['image_name'] ?>" alt="">
                                 <?php
                                    }
                                 ?>
                                    </div>
            
                                    <p class="item-title"><?php echo $prod_row['prod_name'] . " - " . $prod_row['spec'] ?></p>
                                 </div>
                              <?php
                           }
                        }
                     }
                  }
               }
               ?>
               </div>
            </div>
           
         </div>
   </section>
   <!-- user account details ends -->

   <!-- top selling item starts here -->
   <?php include "../partials/top-selling.php"; ?>
   <!-- top selling items section ends here -->

<?php include "../partials/footer.php"; ?>