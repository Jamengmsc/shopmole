<?php
   $caption = "Dashboard";
   include "../partials/admin-setup.php"; 
 ?>


<!-- dashboard panel starts -->
<div class="panel">
   <div class="panel-item">
      <div>
         <div class="number">83</div>
         <div class="cardName">all categories</div>
      </div>

      <div class="iconBox">
         <i class="fas fa-eye"></i>
      </div>
   </div>
   
   <div class="panel-item">
      <div>
         <div class="number">315</div>
         <div class="cardName">total food</div>
      </div>

      <div class="iconBox">
         <i class="fas fa-shopping-cart"></i>
      </div>
   </div>

   <div class="panel-item">
      <div>
      <?php
         $total_order = "SELECT order_id FROM orders WHERE active=1 GROUP BY order_id";
         $total_order_res = mysqli_query($conn, $total_order);
         $count_orders = mysqli_num_rows($total_order_res);
      ?>
         <div class="number"><?php echo $count_orders ?></div>
         <div class="cardName">total orders</div>
      </div>

      <div class="iconBox">
         <i class="fas fa-comments"></i>
      </div>
   </div>

   <div class="panel-item">
      <div>
            <?php
               $earning = "SELECT SUM(qty * price) as total FROM orders WHERE order_status='Delivered'";
               $earning_res = mysqli_query($conn, $earning);
               $count_earning = mysqli_num_rows($earning_res);

               $earning_row = mysqli_fetch_assoc($earning_res);
            ?>
         <div class="number">&#8358; <span>
            <?php
               if($earning_row['total'] == 0){
                  echo "0.00";
               }
               else{
                  echo $earning_row['total'];
               }
            ?>
         </span></div>
         <div class="cardName">total earnings</div>
      </div>

      <div class="iconBox">
         <i class="fas fa-dollar-sign"></i>
      </div>
   </div>
</div>
<!-- dashboard panel ends -->


<!-- details section starts -->
<div class="details">
   <div class="recentOrders">
      <div class="cardHeader">
         <h2>recent orders</h2>
         <a href="#" class="btn">view all >></a>
      </div>
   
      <table>
         <thead>
            <tr>
               <td style='width:45%'>orders</td>
               <td class="text-center pr-3">Order No.</td>
               <td class="text-center">Total qty</td>
               <td class="text-right">order date</td>
            </tr>
         </thead>
         <tbody>
         <?php
            $query = "SELECT SUM(qty*price) as total, SUM(qty) as qty, order_id, order_date FROM orders GROUP BY order_id ORDER BY order_date DESC LIMIT 8";
            $result = mysqli_query($conn, $query);
            $count_res = mysqli_num_rows($result);
            if($count_res>0){
               while($ord_row = mysqli_fetch_assoc($result)){
            ?>
               <tr>
                  <td>
                     <?php
                        $get_orders = "SELECT prod_id, order_status from orders where order_id='".$ord_row['order_id']."'";
                        $get_orders_res = mysqli_query($conn, $get_orders);
                        $count_id = mysqli_num_rows($get_orders_res);
                        if($count_id>0){
                           $row = mysqli_fetch_assoc($get_orders_res);
                           $prod_id = $row['prod_id'];

                           $get_prod = "SELECT prod_name from products where prod_id=$prod_id";
                           $get_prod_res = mysqli_query($conn, $get_prod);
                           $count_prod = mysqli_num_rows($get_prod_res);

                           if($count_prod==1){
                              $prod_row = mysqli_fetch_assoc($get_prod_res);

                              if($count_id - 1 < 1){
                                 echo $prod_name = "<div>" . $prod_row['prod_name'] . "</div>";
                              }
                              else{
                                 echo $prod_name = "<span>" . $prod_row['prod_name'] . "</span> <span class='text-lowercase text-danger opacity-1'>and " . $count_id - 1 . " more</span>";
                              }
                           }
                        }
                     ?>

                  </td>
                     <td class="text-center"><?php echo  $ord_row['order_id'] ?></td>
                     <td class="text-center"><?php echo $ord_row['qty'] ?></td>
                     <td class="text-right pr-0"><span class="status">
                        <?php
                           $date = $ord_row['order_date'];
                           $date = strtotime($date);
                           echo $date = date("M d, Y", $date);
                        ?>
                     </span>
                  </td>
               </tr>
            <?php
               }
            }
         ?>
            
         </tbody>
      </table>
   </div>

   <div class="recentCustomers">
      <div class="cardHeader mb-3">
         <h2 class="font-weight-bold">Recent Customers</h2>
      </div>

      <table>
         <thead>
         
         <?php
            $sql = "SELECT * FROM customers WHERE active='Yes' LIMIT 7";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count>0){
               while($rows = mysqli_fetch_assoc($res)){
            ?>
               <tr>
                  <td width="50px">
                     <div class="imgBx">
                        <?php
                           if($rows['image_url'] !=""){
                        ?>
                           <img src="../images/customers/<?= $rows['image_url'] ?>">
                        <?php
                           }
                        ?>
                     </div>
                  </td>

                  <td>
                     <h4 class="mt-1">
                        <?php echo $rows['firstname'] . " " . $rows['lastname'] ?><br><span><?php echo $rows['country'] ?></span>
                     </h4>
                  </td>
               </tr>
            <?php
               }
            }
         ?>

         </thead>
      </table>
   </div>
</div>
<!-- details section ends -->
 

<?php include "../partials/admin-footer.php"; ?>