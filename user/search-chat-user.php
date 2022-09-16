<?php
   include "../config/constants.php";
   include "../config/session.php";
   header('Access-Control-Allow-Origin: *');

   
   if(isset($_GET['q'])){
      $search = $_GET['q'];
      $id = $_SESSION['id'];

     $sql = mysqli_query($conn, "SELECT * FROM customers where not id=$id and firstname LIKE '%$search%' OR lastname LIKE '%$search%' and online=1");

     $output = "";

     if(mysqli_num_rows($sql) == 0){
         echo "<div style='text-align:center; font-weight:bold; font-style:italic'>No user available to chat</div>";
     }
      if(mysqli_num_rows($sql) > 0){
         while($user_row = mysqli_fetch_assoc($sql)){
            $fname = $user_row['firstname'];
            $lname = $user_row['lastname'];
            $rec = $user_row['id'];
            $user_img = $user_row['image_url'];
            $user_stat = $user_row['online'];
            
            $output .= '<a onclick="chatUser(event,' . $rec . ')" href="' . SITEURL . 'chat-user.php?rec_id=' . $rec . '&send_id=' . $id .'">
               <div class="user_details">
                  <div class="user_img">
                     <img src="../images/customers/' . $user_img . '?>">
                  </div>
                  <div class="user_info">
                     <div class="user_name">' . ucfirst(strtolower($fname)) . " " . ucfirst(strtolower($lname)) . '</div>
                     <div class="last_msg">Talk to you tomorrow</div>
                  </div>
                  </div>
                  
                  <div class="user_status" style="color:#07c25b; margin-right:10px"><i class="fas fa-circle"></i></div>
            </a>';
         }
      }
      echo $output;
   }
?>