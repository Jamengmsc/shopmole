<?php
  include "../config/constants.php";

  if(isset($_GET['prod_id']) && isset($_GET['user_id'])){
    $prod_id = $_GET['prod_id'];
    $user_id = $_GET['user_id'];

    $sql = "DELETE FROM cart WHERE prod_id=$prod_id AND user_id=$user_id";
    $res = mysqli_query($conn, $sql);

    if($res==true){
      echo "<script>alert('Cart Item Successfully Deleted')</script>";
      header("location:" . SITEURL . 'user/cart.php');
    }
  }
?>