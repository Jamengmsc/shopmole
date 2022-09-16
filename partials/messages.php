<?php
   include "../config/constants.php";
   header('Access-Control-Allow-Origin: *');

   $sender = mysqli_real_escape_string($conn, $_POST['sender']);
   $receiver = mysqli_real_escape_string($conn, $_POST['receiver']);
   $msg = mysqli_real_escape_string($conn, $_POST['message']);
   
   if(!empty($msg)){
      $send_chat = mysqli_query($conn, "INSERT INTO chats (msg_incoming_id, msg_outgoing_id, msg) VALUES ($receiver, $sender, '$msg')");

      if($send_chat==true){
         echo "success";
      }
      else{
         echo "Failed to send message";
      }
   }
   else{
      echo "There's no message in the input field";
   }
?>


  