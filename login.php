<?php
session_start();
if( isset($_POST["username"]) ) {
   if( !empty($_POST["username"]) ) {
      require("database.php");
      if( $sql = $conn->prepare("SELECT pword FROM Login WHERE username = ? AND pword = SHA1(?)") ) {
         $uname = $_POST["username"];
         $pword = $_POST["pword"];
         /* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
         if( !$sql->bind_param("ss", $uname, $pword)) {
            echo "Binding parameters failed: (" . $sql->errno . ") " . $sql->error;
         }
         $sql->execute();
         $sql->store_result();
         //could also use get_result()
         $result = $sql->bind_result($db_pass);
         if( $sql->fetch() ) {
            $_SESSION["username"] = $uname;
         }
      } else {
         die("Cound not prepare SQL: " . $conn->error);
      }
      $sql->close();
      $conn->close();
   }
}
header("location:index.php");
?>
