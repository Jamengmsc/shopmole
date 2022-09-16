<?php
   if(!isset($_SESSION['id'])){
      echo "<script>location.href='../customer/login.php'</script>";
   }
?>