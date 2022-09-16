<?php

   if(isset($_SESSION['id'])){
      $id = $_SESSION['id'];

      $user_status = mysqli_query($conn, "UPDATE customers SET online=1 where id=$id");
   }
?>