<?php
   include "../config/constants.php";

   if(isset($_GET['q'])){
      $shop_name = $_GET['q'];

      $sql = mysqli_query($conn, "SELECT id FROM shops WHERE shop_name='$shop_name'");
      if(mysqli_num_rows($sql) == 1){
         $shop_row = mysqli_fetch_assoc($sql);
         $shop_id = $shop_row['id'];
      }

      $sql1 = "SELECT cat_name FROM category where shop_id=$shop_id ORDER BY cat_name";
      $res1 = mysqli_query($conn, $sql1);
      $count1 = mysqli_num_rows($res1);

      if($count1>0){
         while($cat_rows = mysqli_fetch_assoc($res1)){
            echo "<option value=" . $cat_rows['cat_name'] . ">" . $cat_rows['cat_name'] . "</option>";
         }
      }
      else{
         echo "<option value=''>No Category Found</option>";
      }
   }

   // Manage category on shop selection
   if(isset($_GET['shop_id'])){
      $shop_id = $_GET['shop_id'];

      $query = mysqli_query($conn, "SELECT id, cat_name FROM category WHERE shop_id=$shop_id");
      if(mysqli_num_rows($query) > 0){
         while($rows = mysqli_fetch_assoc($query)){
            echo "<option value=" . $rows['id'] . ">" . $rows['cat_name'] . "</option>";
         }
      }
      else{
         echo "<option value=''>No Category Found</option>";
      }
   }
?>

