<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login - Shopping</title>

   <!-- Font awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- CSS Styling -->
   <link rel="stylesheet" href="../css/admin.css">

</head>
<body>
   <div class="login">
      <div class="loginHead">
         <h2>login</h2>
      </div>

      <div class="loginForm">
         <form action="" method="post">
            <table>
               <tr>
                  <td><label for="username">enter email</label></td>
               </tr>
               <tr>
                  <td><i class="fas fa-envelope"></i><input type="email" name="email" id="email" placeholder="Enter Email..."></td>
               </tr>
   
               <tr>
                  <td><label for="password">password</label></td>
               </tr>
               <tr>
                  <td><i class="fas fa-lock"></i><input type="password" name="password" id="password" placeholder="Enter Password..."></td>
               </tr>
            </table>
            
            <input type="submit" value="Login" class="button">

            <div class="remReg">
               <span class="register-now">new member? <a href="#">register now</a></span>
               <span class="remember"><input type="checkbox" name="remember" id="">&nbsp; remember me</span>
            </div>
         </form>

      </div>
   </div>
</body>
</html>