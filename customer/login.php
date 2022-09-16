<?php
   $caption = "Login";
   include "../partials/header.php";

   if(isset($_SESSION['id'])){
      echo "<script>location.href='../user/index.php'</script>";
   }
?>

<?php
   $error = array();

   if(isset($_POST['submit'])){
      
      $email = $_POST['email'];
      $password = md5($_POST['password']);

      if(empty($email) || empty($password)){
         $error[] = "Incomplete login details!";
      }
      else {
         $sql = "SELECT * FROM customers WHERE email='$email' AND password='$password'";
         $res = mysqli_query($conn, $sql);

         if(mysqli_num_rows($res) == 1){
            $row = mysqli_fetch_assoc($res);
            $_SESSION['id'] = $row['id'];
            $firstname = $row['firstname'];

            echo "<script>location.href='../user/index.php'</script>";
         }
         else{
            $error[] = "Email and password details do not match";
         }
      }
   }
?>


   <!-- Inbox details starts -->
   <section class="user-account login" id="login">
      <div class="login-wrap">
      
         <div class="login_msg" style="color:red; font-style:italic">
            <p>
            <?php
               if($error){
                  foreach($error as $key => $val){
                     echo $val;
                  }
               }
            ?>
            </p>
         </div>

         <div class="login-main">
            <form action="" method="POST">
               <h5>login</h5>

               <div class="form-group">
                  <input type="email" name="email" id="email" placeholder="E-mail" autocomplete="off">
               </div>
               <div class="form-group">
                  <i class="fas fa-eye-slash"></i>
                  <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
               </div>

               <div class="akan">
                  <span class="remember-me">
                     <input type="checkbox" name="" id="">
                  </span>

                  <div class="forget-pwd">
                     <a href="#">Forgot your password?</a>
                  </div>
               </div>

               <button id="loginBtn" name="submit" type="submit"><i class="fas fa-envelope"></i>LOGIN</button>
               <button id="logWithFbk" type="submit"><a href="#"><i class="fab fa-facebook-square"></i> login with facebook</a></button>
            </form>
            
            <div class="create-account">
               <h5>Register New Account</h5>

               <p>Register a new account with our shopping site to be able to shop in cart and place orders in just few clicks</p>

               <a href="<?php echo SITEURL; ?>customer/create-account.php">Create Account</a>
            </div>
         </div>
   </section>
   <!-- user account details ends -->


<?php include "../partials/footer.php"; ?>