<?php
class regValidate {
   private $error = 0;
   public function userRegister($regusername, $regpassword, $regemail, $firstname, $lastname, $phonenumber) {
      $user = trim($regusername);
      $pass = trim($regpassword);
      $email = trim($regemail);
      $fname = trim($firstname);
      $lname = trim($lastname);
      $phone = trim($phonenumber);
      if (isset($user) && isset($pass) && isset($email) && isset($fname) && isset($lname) && isset($phone)) {
         if( 1 == $this->existsUser($user)) {
            $this->set_error(1);
         } else {
            $this->set_error(0);
            $this->register_go($user, $pass, $email, $fname, $lname, $phone);
         }
      } else {
         $this->set_error(1);
      }
   }
   public function get_error() {
      return $this->error;
   }
   public function set_error($err) {
      $this->error = $err;
   }
   private function register_go($user, $pass, $email, $fname, $lname, $phone) {
      require("database.php");
      $sql = " INSERT INTO Clients VALUES";
      $sql .= " ((SELECT max(c.cid) from Clients c)+1, ?, ?, ?, ?)";


      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("ssis", $lname, $fname, $phone, $email);
         $stmt->execute();
      } else {
         $this->set_error(1);
         return 0;
      }

      $sql = "INSERT INTO Login VALUES ((SELECT max(cid) from Clients), ?, SHA1(?))";

      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("ss", $user, $pass);
         $stmt->execute();
      } else {
         $this->set_error(1);
         return 0;
      }
      $stmt->close();
      $conn->close();
      header("Location: register_success.php");
   }
   private function existsUser($username) {
      require("database.php");
      $sql = "SELECT username FROM Login l
              WHERE l.username = ?";

      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("s", $username);
         $stmt->execute();
         $stmt->bind_result($db_username);
         if( $stmt->fetch() ) {
            return 1;
         } else {
            return 0;
         }
      }
      $stmt->close();
      $conn->close();
      return 0;
   }
}

?>
