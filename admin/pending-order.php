<?php
   $caption = "Pending Orders";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 pending_order all-products">
  <div class="d-flex justify-content-between align-items-center">
    <h4 class="gen_setup p-0 mt-3">Pending Orders</h4>

    <?php
      if(isset($_SESSION['status-updated'])){
        echo $_SESSION['status-updated'];
        unset($_SESSION['status-updated']);
      }
    ?>
  </div>
   <hr>

   <table class="w-100 table">
      <tr>
         <th style="width:30%;" class="text-left pl-2">Orders</th>
         <th class="text-left pl-3">Customer</th>
         <th class="pl-3 text-center">Qty</th>
         <th class="text-left pl-3">Order Date</th>
         <th>Delivery Date</th>
         <th class="text-center">Action</th>
      </tr>

   <?php
      $sql = "SELECT SUM(qty) as qty, order_id, user_id, order_date FROM orders WHERE order_status='Pending' GROUP BY order_id";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if($count>0){
         while($rows = mysqli_fetch_assoc($res)){
      ?>
         <tr>
            <!-- Get order products from products ID in orders table in database -->
            <td style="width: 12%;">
               <a class="text-decoration-none" href="<?php echo SITEURL ?>customer/order-details.php?order_id=<?php echo $rows['order_id'] ?>">
                  <?php
                     $prod_id = "SELECT prod_id FROM orders WHERE order_id='".$rows['order_id']."'";
                     $prod_id_res = mysqli_query($conn, $prod_id);
                     $count_id = mysqli_num_rows($prod_id_res);
                     if($count_id>0){
                        $row = mysqli_fetch_assoc($prod_id_res);
                        $prods = $row['prod_id'];

                        $get_prod = "SELECT prod_name from products where prod_id=$prods";
                        $get_prod_res = mysqli_query($conn, $get_prod);
                        $count_prod = mysqli_num_rows($get_prod_res);

                        if($count_prod==1){
                           $prod_row = mysqli_fetch_assoc($get_prod_res);

                           if($count_id - 1 < 1){
                              echo $prod_name = "<span class='text-dark'>" . $prod_row['prod_name'] . "</span>";
                           }
                           else{
                              echo $prod_name = "<span class='text-dark'>" . $prod_row['prod_name'] . " </span><span class='text-danger'> and " . $count_id - 1 . " more</span>";
                           }
                        }
                     }
                  ?>
               </a>
            </td>

            <!-- Get customer firstname and lastname -->
            <td style="width: 20%; text-transform:capitalize;">
              <?php
                $cust = "SELECT firstname, lastname FROM customers WHERE id='".$rows['user_id']."'";
                $cust_res = mysqli_query($conn, $cust);
                if(mysqli_num_rows($cust_res)==1){
                  $cust_row = mysqli_fetch_assoc($cust_res);

                  echo $cust_row['firstname'] . " " . $cust_row['lastname'];
                }
              ?>
          </td>
            <td class="px-3 text-center"><?php echo $rows['qty'] ?></td>
            <!-- Order Date -->
            <td style="width:15%">
               <?php
                  $date = strtotime($rows['order_date']);
                  echo $ord_date = date("M d, Y", $date);
               ?>
            </td>
            <!-- Delivery Date -->
            <td style="width: 12%;">
                <?php
                  $del_date = strtotime($ord_date);
                  $del_date = strtotime("+7 day", $del_date);
                  echo $del_date = date("M d, Y", $del_date);
                ?>
            </td>
            <!-- Confirm order button -->
            <td class="text-center">
               <a class="confirm_order" href="<?= SITEURL ?>admin/confirm-order.php?order_id=<?= $rows['order_id'] ?>&user_id=<?php echo $rows['user_id'] ?>">Confirm Order</a>
            </td>
         </tr>
      <?php
         }
      }
      else{
      ?>
      <!-- Write this for no pending order item -->
         <tr>
            <td colspan="6" class="text-center text-dark font-italic py-3" style="font-size:15px;">No Pending Orders</td>
         </tr>
      <?php
      }
   ?>
      
   </table>
</div>


<?php include "../partials/admin-footer.php"; ?>