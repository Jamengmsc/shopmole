<div class="sidemenu">
   <ul>
      <li>
         <a href="<?php echo SITEURL; ?>customer/my-account.php">
            <div class="sidemenu-icon"><i class="far fa-user"></i></div>
            <div class="sidemenu-text">my shopping account</div>
         </a>
      </li>

      <li>
         <a href="<?php echo SITEURL; ?>customer/order.php">
            <div class="sidemenu-icon"><i class="fas fa-baby-carriage"></i></div>
            <div class="sidemenu-text">my orders</div>
         </a>
      </li>

      <?php
         $sql = "SELECT user_id FROM cust_inbox WHERE user_id=$id and active=0";
         $res = mysqli_query($conn, $sql);
         $count = mysqli_num_rows($res);
      ?>

      <li>
         <a href="<?php echo SITEURL; ?>customer/inbox-read.php?user_id=<?php echo $id ?>" class="inbox">
            <div class="sidemenu-icon"><i class="fas fa-envelope-open-text"></i></div>
            <div class="sidemenu-text">inbox <span class="inbox-unread"><?= $count; ?></span></div>
         </a>
      </li>

      <li>
         <a href="<?php echo SITEURL; ?>customer/pending-view.php">
            <div class="sidemenu-icon"><i class="fas fa-envelope-open-text"></i></div>
            <div class="sidemenu-text">pending review</div>
         </a>
      </li>

      <li>
         <a href="<?php echo SITEURL; ?>customer/saved-item.php">
            <div class="sidemenu-icon"><i class="far fa-heart"></i></div>
            <div class="sidemenu-text">saved items</div>
         </a>
      </li>

      <li>
         <a href="<?php echo SITEURL; ?>customer/recent-view.php">
            <div class="sidemenu-icon"><i class="fas fa-eye"></i></div>
            <div class="sidemenu-text">recently viewed</div>
         </a>
      </li>

      <li class="user-info">
         <a href="<?php echo SITEURL; ?>customer/edit-account.php">
            <div class="sidemenu-text">details</div>
         </a>
      </li>

      <li>
         <a href="<?php echo SITEURL; ?>customer/address-book.php">
            <div class="sidemenu-text">address book</div>
         </a>
      </li>

      <li>
         <a href="<?php echo SITEURL; ?>customer/change-password.php">
            <div class="sidemenu-text">change password</div>
         </a>
      </li>

      <li>
         <a href="<?php echo SITEURL; ?>customer/reference.php">
            <div class="sidemenu-text">references</div>
         </a>
      </li>

      <li>
         <a href="<?php echo SITEURL; ?>logout.php">logout</a>
      </li>
   </ul>
</div>

<script>
   var sidemenu = document.querySelectorAll(".sidemenu ul li");

      for(var i = 0; i < sidemenu.length; i++){
         sidemenu[i].onclick = function(){
            this.classList.add("active");
         };
      }
</script>