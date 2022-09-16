<?php
   include "../config/constants.php";
   header('Access-Control-Allow-Origin: *');

   echo $sender = mysqli_real_escape_string($conn, $_POST['sender']) . " ";
   echo $receiver = mysqli_real_escape_string($conn, $_POST['receiver'])
?>