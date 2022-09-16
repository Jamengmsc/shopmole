<?php
   $caption = "New Account";
   include "../partials/header.php";

   $email = "jamengmsc@gmail.com";
   $ePassword = "engine315";
?>

<?php
        $subject = "ShopMole Account Opened Successfully";
         $body = "
                  <div style='width:90%; margin:0 auto; padding:10px 15px 30px 15px; background:rgba(0,0,0,.05); border-radius:5px'>
                     <p><b>Hi " . $firstname . ",</b></p>

                     <p>Thank you for signing up with ShopMole. Your account will be set up in a few minutes.</p>
                     
                     <p>Below are the details of your new shopmole account: </p>
                     <br>
                     
                     <h3 style='color:orange; padding:0'>Your ShopMole Account Details</h3>

                     <span><b>Email:</b>&nbsp; &nbsp; " . $email . "</span><br>
                     <span><b>Password:</b>&nbsp; &nbsp; " . $ePassword . "</span>
                     
                     <br>
                     <p>Keep your password confidential and in case of any fraud on your account, kindly <a href='". SITEURL ."customer/change-password.php'>reset you password</a> to retrieve your account and continue shopping on ShopMole</p>

                     <br>

                     <a style='display:block; padding:10px;border-radius:4px;background:#34495e;color:white;border:none;text-align:center' href='" . SITEURL . "user/index.php'>Activate Your Account</a>

                     <br>
                     <br>

                     <p style='padding:0; margin:0'>Regards,</p>
                     <p style='padding:0; margin:0'><b>ShopMole</b></p>

                  </div>
               ";

               // Send HTML element tag in the mail
               include "../mail/phpmailer/PHPMailerAutoload.php";
               $mail = new PHPMailer;

               $mail->addAddress($email);
               $mail->Subject = $subject;
               $mail->Body = $body;
               $mail->Send();


               if(!$mail->Send()){
                echo "Message could not be sent";
                  }
                  else{
                    echo "Message is successfully sent";
                  }

            // include "../mail/index.php";

  ?>