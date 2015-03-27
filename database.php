<?php
   $servername = "127.0.0.1";
   $username = "client";
   $password = "iamclient";
   $dbname = "bdbank";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
?>
