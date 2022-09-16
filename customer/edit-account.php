<?php
   $caption = "Edit Account";
   include "../partials/header.php";
   include "../config/auth.php";
?>


   <!-- edit account starts -->
   <section class="user-account edit-account" id="edit-account">
      <div class="wrapper">
         <?php include "../partials/sidemenu.php"; //Sidemenu for customers' page ?>
   
         <div class="main">
            <h5><a href="#" onclick="history.go(-1)"><i class="fas fa-arrow-left"></i></a> Account Details</h5>

            <?php
               if(isset($_SESSION['upd-cust'])){
                  echo $_SESSION['upd-cust'];
                  unset($_SESSION['upd-cust']);
               }
            ?>

            <?php
               if(isset($_SESSION['upd-address'])){
                  echo $_SESSION['upd-address'];
                  unset($_SESSION['upd-address']);
               }
            ?>

         <?php
            $sql = "SELECT * FROM customers WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($res)==1){
               $row = mysqli_fetch_assoc($res);
            }  
         ?>

            <form action="" method="POST">
               <div class="edit-input">
                  <div class="detail1">
                     <div class="form-group">
                        <label for="firstname">First Name</label><br>
                        <input type="text" name="firstname" id="firstname" value="<?= $row['firstname'] ?>">
                     </div>
                     <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" name="email" id="email" value="<?= $row['email'] ?>">
                     </div>
                     <div class="form-group">
                        <label for="gender">Gender (Optional)</label><br>
                        <select name="gender" id="gender">
                           <option value="Male" <?php if($row['gender'] =="Male") { echo "selected"; } ?>>Male</option>
                           <option value="Female" <?php if($row['gender'] =="Female") { echo "selected"; } ?>>Female</option>
                        </select>
                     </div>
                  </div>
   
                  <div class="detail2">
                     <div class="form-group">
                        <label for="lastname">Last Name</label><br>
                        <input type="text" name="lastname" id="lastname" value="<?= $row['lastname'] ?>">
                     </div>
                     <div class="form-group">
                        <label for="mobile">Phone Number (Optional)</label><br>
                        <input type="text" name="mobile" id="mobile" value="<?= $row['mobile'] ?>">
                     </div>
                     <div class="form-group">
                        <label for="gender">Date Of Birth (Optional)</label><br>
                        <input type="date" name="birthday" id="birthday" value="<?= $row['dob'] ?>">
                     </div>
                  </div>
               </div>

               <input type="submit" name="submit" id="submit" value="SAVE">
            </form>

         <?php
            if(isset($_POST['submit'])){
               // Get user data from form
               $firstname = $_POST['firstname'];
               $lastname = $_POST['lastname'];
               $email = $_POST['email'];
               $gender = $_POST['gender'];
               $mobile = $_POST['mobile'];
               $birthday = $_POST['birthday'];

               $query = "UPDATE customers SET
                  firstname = '$firstname',
                  lastname = '$lastname',
                  email = '$email',
                  gender = '$gender',
                  mobile = '$mobile',
                  dob = '$birthday'

                  WHERE id=$id
               ";

               $result = mysqli_query($conn, $query);

               if($result==true){
                  $_SESSION['upd-cust'] = "<div style='margin-top:15px; font-size:16px; color: green; margin-bottom:-15px'>Your Account is Successfully Updated";
                  echo "<script>location.href='my-account.php'></script>";
               }
            }
         ?>
           
         </div>
   </section>


<?php include "../partials/footer.php"; ?>