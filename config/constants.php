<?php
   // Start all sessions in the project
   session_start();

   // Define constants
   define("SITEURL", "http://localhost/shopping/");
   define("EMAIL", "shopmole200@gmail.com");
   define("EMAILPASS", "SHOPmole_200");
   define("DB_HOST", "localhost");
   define("DB_USERNAME", "root");
   define("DB_PASSWORD", "");
   define("DB_NAME", "shopping");

   // Connection to database
   $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
   $db_select = mysqli_select_db($conn, DB_NAME);
?>