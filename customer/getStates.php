<?php
   include "../config/constants.php";

   if(isset($_GET['q'])){
      $country_code = $_GET['q'];
      
      $sql = "SELECT DISTINCT state FROM states WHERE country_code='$country_code' ORDER BY state";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if($count>0){
         while($rows = mysqli_fetch_assoc($res)){
            echo "<option value=". $rows['state'] .">". $rows['state'] ."</option>";
         }
      }
   }
?>