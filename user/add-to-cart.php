<?php include "../config/constants.php";

if(isset($_GET['prod_id']) && isset($_GET['user_id'])){
   $prod_id = $_GET['prod_id'];
   $user_id = $_GET['user_id'];

   $query_check = "SELECT * FROM cart WHERE user_id=$user_id AND prod_id=$prod_id";
   $check_res = mysqli_query($conn, $query_check);
   $count_check = mysqli_num_rows($check_res);

   if($count_check>0){
      $_SESSION['add-to-cart'] = "<div style='margin-bottom:10px; color:red; font-weight:600; font-size:16px'>Product already exists in your cart list</div>";
      exit;
   }

   $query = "SELECT price, qty, discount FROM products WHERE prod_id=$prod_id";
   $Result2 = mysqli_query($conn, $query);
   
   if(mysqli_num_rows($Result2)==1){
      $val = mysqli_fetch_assoc($Result2);

      $price = ((100-$val['discount']) * $val['price'])/100;
      $qty = $val['qty'];
   }

   $qty = 1;

   $query1 = "INSERT INTO cart SET
      user_id = $user_id,
      prod_id = $prod_id,
      price = $price,
      qty = $qty
   ";

   $cart_res = mysqli_query($conn, $query1);
   header("location:" . SITEURL . "user/view-item.php?prod_id=" . $prod_id);
}

?>