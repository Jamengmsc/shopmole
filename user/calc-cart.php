<?php
   include "../config/constants.php";
   
   if(isset($_GET['qty'])){
      $qty = $_GET['qty'];
      $prod_id = $_GET['prod_id'];
      $user_id = $_GET['user_id'];


      $sql = "UPDATE cart SET
         qty = $qty

         WHERE prod_id=$prod_id && user_id=$user_id
      ";

      $res = mysqli_query($conn, $sql);
      if($res==true){
         echo "success";
      }
   }
?>