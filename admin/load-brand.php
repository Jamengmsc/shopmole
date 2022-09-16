<?php
   include "../config/constants.php";

   if(isset($_GET['q'])){
      $cat_name = $_GET['q'];

      $sql = mysqli_query($conn, "SELECT id FROM category WHERE cat_name='$cat_name'");
      if(mysqli_num_rows($sql) == 1){
         $cat_row = mysqli_fetch_assoc($sql);
         $cat_id = $cat_row['id'];
      }

      $sql1 = "SELECT brand_name FROM brands where cat_id=$cat_id ORDER BY brand_name";
      $res1 = mysqli_query($conn, $sql1);
      $count1 = mysqli_num_rows($res1);

      if($count1>0){
         while($brand_rows = mysqli_fetch_assoc($res1)){
            echo "<option value=" . $brand_rows['brand_name'] . ">" . $brand_rows['brand_name'] . "</option>";
         }
      }
      else{
         echo "<option value=''>No Brand Found</option>";
      }
   }
?>