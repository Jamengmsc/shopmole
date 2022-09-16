<?php include "../config/constants.php"; ?>

<?php
   if(isset($_GET['cust_id']) && isset($_GET['image_name'])){
      $cust_id = $_GET['cust_id'];
      $image_name = $_GET['image_name'];

      if($image_name !=""){
         $image_path = "../images/customers/" . $image_name;

         // Remove image from folder
         $remove_img = unlink($image_path);

         if($remove_img==false){
            $_SESSION['upd-customer'] = "<div>Failed to Remove Customer Image</div>";
            header("location:" . SITEURL . 'admin/customers-list.php'); //Redirect to customers list
            die(); //Stop the process
         }
      }

      // Delete all orders for this customer
      $del_order = "DELETE FROM orders WHERE user_id=$cust_id";
      $del_order_res = mysqli_query($conn, $del_order);

      // Delete all cart items for this customer
      $del_cart = "DELETE FROM cart WHERE user_id=$cust_id";
      $del_cart_res = mysqli_query($conn, $del_cart);

      // Delete all inbox messages for this customer
      $del_inbox = "DELETE FROM cust_inbox WHERE user_id=$cust_id";
      $del_inbox_res = mysqli_query($conn, $del_inbox);

      // Delete all saved items for this customer
      $del_saved = "DELETE FROM saved_prod WHERE user_id=$cust_id";
      $del_saved_res = mysqli_query($conn, $del_saved);

      // Delete the customer
      $sql = "DELETE FROM customers WHERE id=$cust_id";
      $res = mysqli_query($conn, $sql);

      if($res==true){
         $_SESSION['upd-customer'] = "<div>Customer Successfully Deleted</div>";
         header("location:" . SITEURL . 'admin/customers-list.php');
      }
      else{
         $_SESSION['upd-customer'] = "<div>Failed to Delete Customer</div>";
         header("location:" . SITEURL . 'admin/customers-list.php');
      }

      // header("location:" . SITEURL . "logout.php");
   }
?>