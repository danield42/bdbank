<?php
class loginValidate {
   private $error = 0;
   public function userLogin($username, $password) {
      $user = trim($username);
      $pass = trim($password);
      if (isset($user) && isset($pass)) {
         if( 1 == $this->verifyLogin($user, $pass)) {
            $this->set_error(0);
            header("Location: summary.php");
         } else {
            $this->set_error(1);
         }
      }
   }
   public function get_error() {
      return $this->error;
   }
   public function set_error($err) {
      $this->error = $err;
   }

   private function verifyLogin($username, $password) {
      require("database.php");
      $sql = "SELECT username FROM Login l
              WHERE l.username = ? AND l.pword = SHA1(?)";

      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("ss", $username, $password);
         $stmt->execute();
         $stmt->bind_result($db_username);
         if( $stmt->fetch() ) {
            if( $db_username == $username ) {
               $_SESSION['username'] = $username;
               $stmt->close();
               return 1;
            }
         } 
      } 
      $stmt->close();
      $conn->close();
      return 0;
   }
}

?>
