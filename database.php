<?php

   $db_servername = "127.0.0.1";
   $db_username = "client";
   $db_password = "iamclient";
   $db_dbname = "bdbank";
   
   // Create connection
   $conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);

   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
?>
