<?php
   $servername = "127.0.0.1";
   $username = "client";
   $password = "iamclient";
   $dbname = "bdbank";

   // Create connection
   $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Error " . mysqli_error($conn));
   // Check connection
?>
