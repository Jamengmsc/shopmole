<?php
   include "config/constants.php";

   if(isset($_SESSION['id'])){
      $id = $_SESSION['id'];

      $user_status = mysqli_query($conn, "UPDATE customers SET online=0 where id=$id");
   }

   session_unset();
   session_destroy();

   echo "<script>location.href='" . SITEURL . "user/index.php'</script>";
?>