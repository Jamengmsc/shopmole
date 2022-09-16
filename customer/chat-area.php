<?php
   include "../config/constants.php";
   include "../config/session.php";
   header('Access-Control-Allow-Origin: *');

   if(isset($_GET['q'])){

      $rec_id = $_GET['q'];
      $senderID = $_GET['r'];

      // Query database for the user to chat with
      $rec_user = mysqli_query($conn, "SELECT * FROM customers WHERE id=$rec_id");
      if(mysqli_num_rows($rec_user) == 1){
         $rec_row = mysqli_fetch_assoc($rec_user);
      }
   }
?>

<!-- Live Chat Window -->
<!-- <section class="chat_area"> -->
   <div class="chat_head">
      <a href="#"><i class="fas fa-arrow-left"></i></a>

      <div class="user_img">
         <img src="../images/customers/<?php echo $rec_row['image_url'] ?>">
      </div>
      <div class="user_info">
         <div class="user_name"><?php echo ucfirst(strtolower($rec_row['firstname'])) . " " . ucfirst(strtolower($rec_row['lastname'])) ?></div>
         <div class="user_status">
            <?php
               if($rec_row['online'] == 1){
                  echo "Online";
               }
               else{
                  echo "<div style='color:gray'>Offline</div>";
               }
            ?>
         </div>
      </div>

      <i class="fas fa-times" onclick="closeChat()"></i>
   </div>

   <div class="chat_body">
      
   </div>

   <!-- Sending chat message form -->
   <div class="typing_area">
      <form action="">
         <input type="hidden" name="sender" value="<?php echo $senderID ?>">
         <input type="hidden" name="receiver" value="<?php echo $rec_id ?>">
         <input type="text" name="message" class="txt" value="" placeholder="Type a message here..." autocomplete="off">
         <button onclick="sendChat(event)" type="submit"><i class="fas fa-paper-plane"></i></button>
      </form>
   </div>
   <!-- </section> -->
