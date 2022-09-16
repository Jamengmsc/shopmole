<?php
   // include "phpmailer/PHPMailerAutoload.php";
   // include "../config/constants.php";
   
   $mail = new PHPMailer;

   $mail->isSMTP(); //Enable this when using on localhost server and otherwise of live server
   $mail->Host = 'smtp.gmail.com';
   $mail->Port = 587;
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = "tls";

   // Sending Email details
   $mail->Username = EMAIL;
   $mail->Password = EMAILPASS;

   $mail->setFrom(EMAIL, "ShopMole");
   $mail->addReplyTo(EMAIL);
   $mail->isHTML(true);
   
   // Send HTML element tag in the mail
   $mail->addAddress($email);
   $mail->Subject = $subject;
   $mail->Body = $body;

   // $mail->AddEmbeddedImage(dirname(__FILE__) . "../images/jumia.png", "shopmole");
   // $mail->AddAttachment("../images/shopmole-logo3.png");

   // Check if the email is not sent
   if(!$mail->Send()){
      echo "Message could not be sent";
   }
   else{
      echo "Message is successfully sent";
   }

?>