<?php
   $caption = "Active Orders";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 pending_order all-products">
  <div class="d-flex justify-content-between align-items-center">
    <h4 class="gen_setup p-0 mt-3">Acitve Orders</h4>

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
         <th>#</th>
         <th class="text-left pl-2">Orders</th>
         <th class="text-left pl-2">Ordering Customer</th>
         <th class="px-3 text-center">Qty</th>
         <th class="text-left pl-2">Order Date</th>
         <th class="text-left pl-2">Delivery Date</th>
         <th class="text-center">Confirmed</th>
         <th class="text-right pr-3">Status</th>
      </tr>

   <?php
      $sql = "SELECT SUM(qty) as qty, order_id, user_id, order_date, order_status FROM orders WHERE order_status='Confirmed' OR order_status='Shipped' AND active=1 GROUP BY order_id";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if($count>0){
         $sn = 1;
         while($rows = mysqli_fetch_assoc($res)){
      ?>
         <tr>
            <td><?php echo $sn++ ?></td>
            <td style="width: 30%;">
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
            <td class="text-left" style="width: 20%">
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
            <td style="width:15%">
                <?php
                  $date = strtotime($rows['order_date']);
                  echo $ord_date = date("M d, Y", $date);
                ?>
            </td>
            <td style="width: 12%;">
                <?php
                  // Delivery Date
                  $del_date = strtotime($ord_date);
                  $del_date = strtotime("+7 day", $del_date);
                  echo $del_date = date("M d, Y", $del_date);
                ?>
            </td>
            <td class="text-center"><i class="fas fa-check"></i></td>
            <td class="text-right text-uppercase text-secondary" style="font-size:12px; font-weight:700">
               <?php
                  if($rows['order_status'] == "Shipped"){
                     echo "<div class='text-info'>" . $rows['order_status'] . "</div>";
                  }
                  elseif($rows['order_status'] == "Confirmed"){
                     echo "<div class='text-secondary'>" . $rows['order_status'] . "</div>";
                  }
                  elseif($rows['order_status'] == "Delivered"){
                     echo "<div class='text-success'>" . $rows['order_status'] . "</div>";
                  }
               ?>
            </td>
         </tr>
      <?php
         }
      }
      else{
      ?>
         <tr><td colspan="8" class="text-center text-danger font-italic font-weight-bold py-2" style="font-size:16px;">No Acitve Order</td></tr>
      <?php
      }
   ?>
      
   </table>
</div>


<?php include "../partials/admin-footer.php"; ?>