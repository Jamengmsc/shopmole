<?php
   $caption = "Edit Address";
   include "../partials/header.php";
   include "../config/auth.php";
?>
   <!-- user account details starts -->
   <section class="user-account edit-account" id="edit-account">
      <div class="wrapper">
         <?php include "../partials/sidemenu.php"; //Sidemenu for customers' page ?>
   
         <div class="main">
            <div style="display:flex; justify-content:space-between; align-items:center;">
               <h5><a href="#" onclick="history.go(-1)"><i class="fas fa-arrow-left"></i></a> Edit Address</h5>
               <span style="margin-right:20px; font-size:16px; color:green; font-weight:600" id="upd-message"></span>
            </div>

         <?php
            $sql = "SELECT * FROM customers WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count==1){
               $row = mysqli_fetch_assoc($res);
            }
         ?>

            <form action="" method="POST">
               <div class="edit-input">
                  <div class="detail1">
                     <div class="form-group">
                        <label for="firstname">first name</label><br>
                        <input type="text" name="firstname" id="firstname" value="<?= $row['firstname'] ?>">
                     </div>
                     <div class="form-group">
                        <label for="mobile">Phone Number (optional)</label><br>
                        <input type="text" name="mobile" id="mobile" value="<?= $row['mobile'] ?>">
                     </div>
                  </div>
   
                  <div class="detail2">
                     <div class="form-group">
                        <label for="lastname">last name</label><br>
                        <input type="text" name="lastname" id="lastname" value="<?= $row['lastname'] ?>">
                     </div>
                     
                     <div class="form-group">
                        <label for="ad-mobile">additional Phone Number</label><br>
                        <input type="text" name="ad-mobile" id="ad-mobile" value="<?= $row['mobile_add'] ?>">
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label for="address">address</label><br>
                  <input type="text" name="address" id="address" value="<?= $row['address'] ?>">
               </div>

               <div class="form-group">
                  <label for="ad-address">additional information</label><br>
                  <input type="text" name="ad-address" id="ad-address" value="<?= $row['address_add'] ?>">
               </div>

               <div class="detail3">
                  <div class="form-group">
                     <label for="country">country</label><br>
                     <select name="country">
                     <?php
                        $sql1 = "SELECT DISTINCT country FROM country";
                        $res1 = mysqli_query($conn, $sql1);
                        $count1 = mysqli_num_rows($res1);

                        if($count1>0){
                           while($row1 = mysqli_fetch_assoc($res1)){
                        ?>
                           <option value="<?= $row1['country'] ?>" <?php if($row1['country'] == $row['country']){ echo "selected"; } ?>><?= $row1['country'] ?></option>
                        <?php
                           }
                        }
                     ?>
                     </select>
                  </div>

                  <?php
                     $sql3 = "SELECT code from country where country='" . $row['country'] . "' GROUP BY country";
                     $res3 = mysqli_query($conn, $sql3);
                     $code = mysqli_fetch_assoc($res3)['code'];
                  ?>
                  
                  <div class="form-group">
                     <label for="state">state</label><br>
                     <select name="state" id="">
                     <?php
                        $sql2 = "SELECT DISTINCT state FROM states where country_code='$code' ORDER BY state";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);

                        if($count2>0){
                           while($row2 = mysqli_fetch_assoc($res2)){
                        ?>
                           <option value="<?= $row2['state'] ?>" <?php if($row2['state'] == $row['state']){ echo "selected"; } ?>><?= $row2['state'] ?></option>
                        <?php
                           }
                        }
                     ?>
                     </select>
                  </div>
               </div>

               <input type="hidden" name="id" value="<?php echo $id ?>">
               <input onclick="updateAddr(event)" type="submit" name="submit" id="submit" value="SAVE">
            </form>
           
         </div>
   </section>
   <!-- user account details ends -->


<?php include "../partials/footer.php"; ?>