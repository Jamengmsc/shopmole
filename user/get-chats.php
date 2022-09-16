<?php
   include "../config/constants.php";
   header('Access-Control-Allow-Origin: *');

   if(isset($_GET['q'])){
      $receiverID = $_GET['q'];
      $senderID = $_GET['r'];
      $output = "";

      $rec_img = mysqli_query($conn, "SELECT image_url from customers where id=$receiverID");
      if(mysqli_num_rows($rec_img) == 1){
         $receiver_img = mysqli_fetch_assoc($rec_img)['image_url'];
      }

      $sql = "SELECT * FROM chats where (msg_incoming_id=$receiverID and msg_outgoing_id=$senderID) 
               or (msg_incoming_id=$senderID and msg_outgoing_id=$receiverID) order by msg_id asc";
      
      $query = mysqli_query($conn, $sql);
      if(mysqli_num_rows($query)>0){
         while($row = mysqli_fetch_assoc($query)){
            if($row['msg_outgoing_id'] == $senderID){ //Sender of the message
               $output .= '<div class="chat outgoing">
                              <div class="details">
                                 <p>' . $row['msg'] . '</p>
                              </div>
                           </div>';
            }
            else{ //Receiver of the message
               $output .= '<div class="chat incoming">
                              <div class="sender_img">
                                 <img src="../images/customers/' . $receiver_img . '">
                              </div>
                              <div class="details">
                                 <p>' . $row['msg'] . '</p>
                              </div>
                           </div>';
            }
         }
         echo $output;
      }
   }
?> 