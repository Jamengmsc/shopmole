<?php
   include "../config/constants.php";
   header('Access-Control-Allow-Origin: *');

   $id = $_SESSION['id'];

   $users = mysqli_query($conn, "SELECT * from customers where not id=$id and active='Yes' and online=1");
   $output = "";

   if(mysqli_num_rows($users) == 0){
      echo "<div style='text-align:center; font-weight:bold; font-style:italic'>No user available to chat</div>";
   }
   elseif(mysqli_num_rows($users) > 0 ){
      while($user_row = mysqli_fetch_assoc($users)){

         $output .= '<a onclick="chatUser(event,' . $user_row['id'] . ' , ' . $id . ')" href="' . SITEURL . 'chat-user.php?rec_id=' . $user_row['id'] . '&send_id=' . $id .'">
               <div class="user_details">
                  <div class="user_img">
                     <img src="../images/customers/' . $user_row['image_url'] . '?>">
                  </div>
                  <div class="user_info">
                     <div class="user_name">' . ucfirst(strtolower($user_row['firstname'])) . " " . ucfirst(strtolower($user_row['lastname'])) . '</div>
                     <div class="last_msg">Talk to you tomorrow</div>
                  </div>
                  </div>
                  
                  <div class="user_status" style="color:#07c25b; margin-right:10px"><i class="fas fa-circle"></i></div>
            </a>';
      }
   }
   echo $output;
?>