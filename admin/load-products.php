<?php 
   include "../config/constants.php";

   if(isset($_GET['search'])){
      $search = $_GET['search'];
      $output = "";

      $sql = "SELECT * FROM products WHERE prod_name LIKE '%$search%' OR category_name LIKE '%$search%' OR brand_name LIKE '%$search%' OR description LIKE '%$search%' OR shop_name LIKE '%$search%' OR spec LIKE '%$search%' ORDER BY prod_name ASC";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
   
      if($count>0){
         while($rows = mysqli_fetch_assoc($res)){
            echo "<option value=" . $rows['prod_id'] . ">" . $rows['prod_name'] . "</option>";
         }
      }
   }
?>