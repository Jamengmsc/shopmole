<?php
   include "../config/constants.php";

   $id = $_POST['id'];
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $mobile = $_POST['mobile'];
   $add_mobile = $_POST['ad-mobile'];
   $address = $_POST['address'];
   $add_address = $_POST['ad-address'];
   $country = $_POST['country'];
   $state = $_POST['state'];

   // Query the datasbase to save changes
   $query = "UPDATE customers SET
   firstname = '$firstname',
   lastname = '$lastname',
   mobile = '$mobile',
   mobile_add = '$add_mobile',
   address = '$address',
   address_add = '$add_address',
   country = '$country',
   state = '$state'

   WHERE id=$id
";

   $result = mysqli_query($conn, $query);
   if($result==true){
      echo "success";
   }
   else{
      echo "Something went wrong!";
   }
?>