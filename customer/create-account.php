<?php
   $caption = "New Account";
   include "../partials/header.php";
?>


<!-- create new account details starts -->
<section class="user-account new-account" id="new-account">
   <div class="account-wrapper">

      <div class="main">
         <div class="caption">
         <h5 id="new-acct-head">create new account</h5>

         <?php
            if(isset($_SESSION['new-account'])){
               echo $_SESSION['new-account'];
               unset($_SESSION['new-account']);
            }
         ?>

         <?php
            if(isset($_SESSION['add-image'])){
               echo $_SESSION['add-image'];
               unset($_SESSION['add-image']);
            }
         ?>
         </div>

         <form action="" method="POST" enctype="multipart/form-data">
            <div class="new-acct-input">
               <div class="sec1">

                  <div class="name">
                     <div class="form-group">
                        <label for="firstname">First Name</label><br>
                        <input type="text" name="firstname" id="firstname" placeholder="First Name">
                     </div>
                     <div class="form-group">
                        <label for="lastname">Last Name</label><br>
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name">
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <label for="mobile">Email</label><br>
                     <input type="email" name="email" id="email" placeholder="Email Address">
                  </div>
                  
                  <div class="phone">
                     <div class="form-group">
                        <label for="firstname">Mobile Number</label><br>
                        <input type="text" name="mobile" id="mobile" placeholder="mobile number">
                     </div>
                     <div class="form-group">
                        <label for="lastname">Other Mobile (Optional)</label><br>
                        <input type="text" name="mobile_add" id="mobile_add" placeholder="other mobile">
                     </div>
                  </div>
                  
                  <div class="personality">
                     <div class="form-group">
                        <label for="lastname">Dirth of Birth</label><br>
                        <input type="date" name="dob" id="dob">
                     </div>

                     <div class="form-input">
                        <label for="firstname">Gender</label><br>
                        <div>
                           <input type="radio" name="gender" value="Male"> Male
                           <input type="radio" name="gender" value="Female"> Female
                        </div>
                     </div>
                  </div>
                  
               </div>

               <div class="sec2">                     
                  <div class="form-group">
                     <label for="address">Address</label><br>
                     <input type="text" name="address" id="address" placeholder="Address">
                  </div>

                  <div class="form-group">
                     <label for="ex_address">Additional Information</label><br>
                     <input type="text" name="address_add" id="address_add" placeholder="Address Additional Information">
                  </div>
                  
                  <div class="location">
                     <div class="form-group">
                        <label for="firstname">Country</label><br>
                        <select name="country" onchange="getStates(this.value)">
                           <option value="country" selected disabled>Select country</option>
                     
                     <?php
                        $sql1 = "SELECT * FROM country";
                        $res1 = mysqli_query($conn, $sql1);

                        if(mysqli_num_rows($res1) > 0){
                           while($rows = mysqli_fetch_assoc($res1)){
                        ?>
                           <option value="<?= $rows['code']; ?>"><?= $rows['country']; ?></option>
                        <?php
                           }
                        }
                     ?>

                        </select>
                     </div>
                     
                     <div class="form-group">
                        <label for="firstname">State</label><br>
                        <select name="state" id="state">
                           <option value="" selected disabled>Select state</option>
                        </select>
                     </div>
                  </div>

                  <div class="cust-password">
                     <div class="form-group">
                        <label for="password">Password</label><br>
                        <input type="password" name="password" id="password" placeholder="Password">
                     </div>
                     <div class="form-group">
                        <label for="conf_password">Confirm Password</label><br>
                        <input type="password" name="conf_password" id="conf_password" placeholder="Confirm Password">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="image">Upload Your Image</label>
                     <input type="file" name="image">
                  </div>

                  <input type="submit" name="submit" id="submit" value="CREATE ACCOUNT">
               </div>
            </div>
         </form>
      
      </div>
</section>
<!-- user account details ends -->


<?php include "../partials/footer.php"; ?>


<?php
   if(isset($_POST['submit'])){
      // Get all the data from the account form
      $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
      $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      
      // check for duplication of customer's email address and terminate the process
      $qry = "SELECT * FROM customers WHERE email='$email'";
      $result = mysqli_query($conn, $qry);
      $count = mysqli_num_rows($result);

      if($count > 0){
         $_SESSION['new-account'] = "<div class='error'>This email address already exists!</div>";
         echo "<script>location.href='create-account.php'</script>";
         die();
      }

      $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
      $mobile_add = mysqli_real_escape_string($conn, $_POST['mobile_add']);
      $dob = mysqli_real_escape_string($conn, $_POST['dob']);

      if(isset($_POST['gender'])){
         $gender = mysqli_real_escape_string($conn, $_POST['gender']);
      }
      else{
         $_SESSION['new-account'] = "<div class='error'>Select your gender type!</div>";
         echo "<script>location.href='create-account.php'</script>";
         die();
      }

      $gender = mysqli_real_escape_string($conn, $_POST['gender']);

      $address = mysqli_real_escape_string($conn, $_POST['address']);
      $address_add = mysqli_real_escape_string($conn, $_POST['address_add']);

      if(isset($_POST['country'])){
         $country = mysqli_real_escape_string($conn, $_POST['country']);
      }else{
         $_SESSION['new-account'] = "<div class='error'>Select your country to continue with registration</div>";
         echo "<script>location.href='create-account.php'</script>";
         die();
      }

      if(isset($_POST['state'])){
         $state = mysqli_real_escape_string($conn, $_POST['state']);
      }else{
         $_SESSION['new-account'] = "<div class='error'>Select your state to continue with registration</div>";
         echo "<script>location.href='create-account.php'</script>";
         die();
      }

      $country = mysqli_real_escape_string($conn, $_POST['country']);
      $state = mysqli_real_escape_string($conn, $_POST['state']);
      $ePassword = $_POST['password'];
      $password = md5($_POST['password']);
      $conf_password = md5($_POST['conf_password']);

      if($conf_password != $password){
         $_SESSION['new-account'] = "<div class='error'>Your passwords do not match</div>";
         echo "<script>location.href='create-account.php'</script>";
         die();
      }

      // Add customer image
      if(isset($_FILES['image']['name'])){
         $image_name = $_FILES['image']['name'];

         $exp_img = explode(".", $image_name);
         $img_extension = end($exp_img);

         $image_name = "Customer_" . rand(100, 999) . "." . $img_extension;

         $Img_src = $_FILES['image']['tmp_name'];
         $img_dest = "../images/customers/" . $image_name;

         $upload_image = move_uploaded_file($Img_src, $img_dest);

         if($upload_image==false){
            $_SESSION['add-image'] = "Failed to Upload Image";
            echo "<script>location.href='create-account.php'</script>";
         }

      }
      else{
         $_SESSION['add-image'] = "No Image Is Selected";
         echo "<script>location.href='create-account.php'</script>";
      }

      
      // Query the database and new customer account
      $sql = "INSERT INTO customers SET 
         firstname = '$firstname',
         lastname = '$lastname',
         email = '$email',
         mobile = '$mobile',
         mobile_add = '$mobile_add',
         dob = '$dob',
         gender = '$gender',
         image_url = '$image_name',
         country = '$country',
         state = '$state',
         address = '$address',
         address_add = '$address_add',
         password = '$password'
      ";
      
      $res = mysqli_query($conn, $sql);

      if($res==true){
         $_SESSION['new-account'] = "<div class='success'></div>";
         echo "<script>location.href='../customer/new-account-action.php'</script>";

         // Send successful account registration email to customer with email and password in the mail
         // Can as well, send the customer's full name in the mail (optional)........
         $subject = "ShopMole Account Opened Successfully";
         $body = "
                  <div style='width:90%; margin:0 auto; padding:10px 15px 30px 15px; background:rgba(0,0,0,.05); border-radius:5px'>
                     <p><b>Hi " . $firstname . ",</b></p>

                     <p>Thank you for signing up with ShopMole. Your account will be set up in a few minutes.</p>
                     
                     <p>Below are the details of your new shopmole account: </p>
                     <br>
                     
                     <h3 style='color:orange; padding:0'>Your ShopMole Account Details</h3>

                     <span><b>Email:</b>&nbsp; &nbsp; " . $email . "</span><br>
                     <span><b>Password:</b>&nbsp; &nbsp; " . $ePassword . "</span>
                     
                     <br>
                     <p>Keep your password confidential and in case of any fraud on your account, kindly <a href='". SITEURL ."customer/change-password.php'>reset you password</a> to retrieve your account and continue shopping on ShopMole</p>

                     <br>

                     <a style='display:block; padding:10px;border-radius:4px;background:#34495e;color:white;border:none;text-align:center' href='" . SITEURL . "user/index.php'>Activate Your Account</a>

                     <br>
                     <br>

                     <p style='padding:0; margin:0'>Regards,</p>
                     <p style='padding:0; margin:0'><b>ShopMole</b></p>

                  </div>
               ";

            include "../mail/index.php";

      }
      else{
         $_SESSION['new-account'] = "<div class='error'>Unable to create a new account</div>";
         echo "<script>location.href='create-account.php'</script>";
      }
   }
?>