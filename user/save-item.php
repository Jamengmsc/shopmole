<?php
   include "../config/constants.php";

   if(isset($_GET['prod_id']) && isset($_GET['user_id'])){
      $prod_id = $_GET['prod_id'];
      $user_id = $_GET['user_id'];

      // Check if item was earlier saved or not
      $res = mysqli_query($conn, "SELECT * FROM saved_prod WHERE user_id=$user_id AND prod_id=$prod_id");
      if(mysqli_num_rows($res)==0){ //if item does not exist
         $status = 1;

      // Insert the item as a saved item
         $ins_prod = "INSERT INTO saved_prod SET
            user_id = $user_id,
            prod_id = $prod_id,
            status = $status
         ";
         $ins_res = mysqli_query($conn, $ins_prod);
         if($ins_res==true){
            // echo "success";
         }
      }
      elseif(mysqli_num_rows($res)==1){ //if item exists
         $result = mysqli_query($conn, "SELECT status FROM saved_prod WHERE user_id=$user_id AND prod_id=$prod_id");

         if(mysqli_num_rows($result)==1){ //check if it exists and is saved
            $row = mysqli_fetch_assoc($result);
            $saved_status = $row['status'];

            if($saved_status==1){ //Item saved then,
               $saved_status = 0; //make it unsaved

               $upd_status = "UPDATE saved_prod SET
                  status = $saved_status

                  WHERE user_id=$user_id AND prod_id=$prod_id
               ";
               $upd_status_res = mysqli_query($conn, $upd_status);
               if($upd_status_res==true){
                  // echo "success";
               }
            }
            elseif($saved_status==0){ //check if it exists but not saved
               $saved_status = 1; //make it saved

               $upd_status = "UPDATE saved_prod SET
                  status = $saved_status

                  WHERE user_id=$user_id AND prod_id=$prod_id
               ";
               $upd_status_res = mysqli_query($conn, $upd_status);
               if($upd_status_res==true){
                  // echo "success";
               }
            }
         }
      }

      header("location:" .SITEURL. "user/cart.php");
   }
?>

