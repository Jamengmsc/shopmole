<?php
   $caption = "Add Shop";
   include "../partials/admin-setup.php"; 
 ?>

<div class="container px-5 setup">
   <h4 class="gen_setup">Add New Shop</h4>
   <hr>

   <form action="" method="post" style="width: 50%;">
      <div class="row">
         <div class="col-12">
            <div class="form-group">
               <label for="cat_name">Shop Name</label><br>
               <input type="text" name="shop" placeholder="Shop Name...">
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-6">
            <div class="form-group active">
               <label for="active" class="mr-3">Active</label>
               Yes <input type="radio" name="active" value="Yes"> &nbsp;
               No <input type="radio" name="active" value="No">
            </div>
         </div>
      </div>

      <input type="submit" name="add_shop" id="add_prod" value="Add Shop">
   </form>

<?php
   if(isset($_POST['add_shop'])){
      // get form data
      $shopname = $_POST['shop'];

      if(isset($_POST['active'])){
         $active = $_POST['active'];
      }
      else{
         $active = "Yes";
      }

      $sql = "INSERT INTO shops SET
         shop_name = '$shopname',
         active = '$active'
      ";

      $res = mysqli_query($conn, $sql);

      if($res==true){
         $_SESSION['add-shop'] = "<div class='mb-2 text-success'>New Shop Successfully Added!</div>";
         echo "<script>location.href='shop-list.php'</script>";
      }
   }
?>

</div>

<?php include "../partials/admin-footer.php"; ?>

