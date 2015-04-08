<?php

   
   function deposit($acc_id, $amount) {
      require("database.php");
     
      $sql = "UPDATE Accounts SET balance = balance + ? where acc_id = ?";
      
      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("di", $amount, $acc_id);
         $stmt->execute();
      } else {
         $_SESSION['error'] = 1;
      }

      $sql = " INSERT INTO History VALUES";
      $sql .= " (NULL, ?, NULL, ?, (SELECT balance from accounts where acc_id = ?), curdate())";

      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("idi", $acc_id, $amount, $acc_id);
         $stmt->execute();
      } else {
         $_SESSION['error'] = 1;
      }
      $stmt->close();
      $conn->close();
   }

   function withdraw($acc_id, $amount) {
      require("database.php");
     
      $sql = "UPDATE Accounts SET balance = balance - ? where acc_id = ?";
      
      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("di", $amount, $acc_id);
         $stmt->execute();
      } else {
         $_SESSION['error'] = 1;
      }

      $sql = " INSERT INTO History VALUES";
      $sql .= " (NULL, ?, ?, NULL, (SELECT balance from accounts where acc_id = ?), curdate())";

      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("idi", $acc_id, $amount, $acc_id);
         $stmt->execute();
      } else {
         $_SESSION['error'] = 1;
      }
      $stmt->close();
      $conn->close();
   }

   function balance($acc_id) {
      require("database.php");
      $sql = "SELECT balance FROM Accounts where acc_id = ?";
      
      if ($stmt = $conn->prepare($sql) ) {

         $stmt->bind_param("i", $acc_id);
         $stmt->execute();
         $stmt->bind_result($db_bal);
         if( $stmt->fetch() ) {
            echo money_format('%(#10n',$db_bal);
         }
         $stmt->close();
      }
      $conn->close();
      return 0;
   }
   function validAccount($acc_id) {
      require("database.php");
      $sql = "SELECT acc_id FROM Accounts where acc_id = ?";
      
      if ($stmt = $conn->prepare($sql) ) {

         $stmt->bind_param("i", $acc_id);
         $stmt->execute();
         $stmt->bind_result($db_acc_num);
         if( $stmt->fetch() ) {
            return 1;
         } else {
            return 0;
         }
         $stmt->close();
      }
      $conn->close();
      return 0;


   
   }
   function isEmployee($username) {
      require("database.php");
      $sql = "SELECT eid";
      $sql .= " FROM Employees e";
      $sql .= " INNER JOIN Login l on l.cid = e.cid";
      $sql .= " WHERE l.username = ?";

      if ($stmt = $conn->prepare($sql) ) {

         $stmt->bind_param("s", $username);
         $stmt->execute();
         $stmt->bind_result($eid);
         if( $stmt->fetch() ) {
            return 1;
         } else {
            return 0;
         }
         $stmt->close();
      }
      $conn->close();
      return 0;
   }
   function gethistory($aid) {
   require("database.php");
// pull latest (last 10) entries for this $username
      $sql = "SELECT trans_id, debits, credits, h.balance, date_format(date, '%M %d %Y')";
      $sql .= " FROM History h";
      $sql .= " INNER JOIN Accounts a on a.acc_id = h.acc_id";
      $sql .= " WHERE a.acc_id = ?";
      $sql .= " ORDER BY trans_id DESC";
//      $sql .= " LIMIT 10";
      
      if ($stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("i", $aid);
         $stmt->execute();
         $stmt->bind_result($tid, $deb, $cred, $bal, $date);
         
         echo "<tr>";
            echo "<th>Transaction ID</th>";
            echo "<th>Debits</th>";
            echo "<th>Credits</th>";
            echo "<th>Balance</th>";
            echo "<th>Transaction Date</th>";
         echo "</tr>";
         $res = "";
         setlocale(LC_MONETARY, 'en_US');
         while ( $stmt->fetch() ) {
            $res .= "<tr><td>";
            $res .= $tid;
            $res .= "</td><td>";
            $res .= money_format('%(#10n',$deb);
            $res .= "</td><td>";
            $res .= money_format('%(#10n',$cred);
            $res .= "</td><td>";
            $res .= money_format('%(#10n',$bal);
            $res .= "</td><td>";
            $res .= $date;
            $res .= "</td></tr>";
         }   
         echo $res;
         $stmt->close();
      }
      $conn->close();
   }
   function getaccounts($username) {
   require("database.php");
      $sql = "SELECT acc_id, balance";
      $sql .= " FROM Accounts a";
      $sql .= " INNER JOIN Login l on a.owner_id = l.cid";
      $sql .= " WHERE l.username = ?";
      
      if ($stmt = $conn->prepare($sql) ) {
      
         $stmt->bind_param("s", $username);
         $stmt->execute();
         $stmt->bind_result($aid, $bal);
         
         
         echo "<tr id=\"table_header\">";
            echo "<th>Account Number</th>";
            echo "<th>Balance</th>";
         echo "</tr>";
         
         $res = "";
         setlocale(LC_MONETARY, 'en_US');
         while ( $stmt->fetch() ) {
            $res .= "<tr onclick=\"document.location='summary.php?aid=" . $aid . "';\">";
            $res .= "<td>";
            $res .= $aid;
            $res .= "</td><td>";
            $res .= money_format('%(#10n',$bal);
            $res .= "</td>";
            $res .= "</tr>";
         }
         echo $res;
         $stmt->close();
      }
      $conn->close();
   }
   function getnameAcc($aid) {  
   require("database.php");
      $sql = "SELECT CONCAT_WS(' ', fname, lname) as full_name";
      $sql .= " FROM Clients c";
      $sql .= " INNER JOIN Accounts a on a.owner_id = c.cid";
      $sql .= " WHERE a.acc_id = ?";

      if ($stmt = $conn->prepare($sql) ) {

         $stmt->bind_param("s", $aid);
         $stmt->execute();
         $stmt->bind_result($name);
         if( $stmt->fetch() ) {
            echo $name;
         }
         $stmt->close();
      }
      $conn->close();
   }

   function getname($username) {  
   require("database.php");
      $sql = "SELECT CONCAT_WS(' ', fname, lname) as full_name";
      $sql .= " FROM Clients c";
      $sql .= " INNER JOIN Login l on l.cid = c.cid";
      $sql .= " WHERE l.username = ?";

      if ($stmt = $conn->prepare($sql) ) {

         $stmt->bind_param("s", $username);
         $stmt->execute();
         $stmt->bind_result($name);
         if( $stmt->fetch() ) {
            echo $name;
         }
         $stmt->close();
      }
      $conn->close();
   }
   function username_owns($username, $aid) {  
   require("database.php");
      $sql = "SELECT username";
      $sql .= " FROM Accounts a";
      $sql .= " INNER JOIN Login l on l.cid = a.owner_id";
      $sql .= " WHERE l.username = ? and a.acc_id = ?";

      if ($stmt = $conn->prepare($sql) ) {

         $stmt->bind_param("si", $username, $aid);
         $stmt->execute();
         $stmt->bind_result($name);
         if( $stmt->fetch() ) {
            if( $name == $username ) {
               return 1;
            } 
         }
         return 0;
         $stmt->close();
      }
      $conn->close();
   }
   function getAccountTypes() {
   require("database.php");
// pull latest (last 10) entries for this $username
      $sql = "SELECT tid, name, interest";
      $sql .= " FROM Account_Types";
      $sql .= " ORDER BY tid ASC";
      
      if ($stmt = $conn->prepare($sql) ) {
         $stmt->execute();
         $stmt->bind_result($tid, $name, $interest);
         
         echo "<tr class='danger'>";
            echo "<th>Transaction ID</th>";
            echo "<th>Name</th>";
            echo "<th>Interest Rate</th>";
         echo "</tr>";
         $res = "";
         while ( $stmt->fetch() ) {
            $res .= "<tr class='active'><td>";
            $res .= $tid;
            $res .= "</td><td>";
            $res .= $name;
            $res .= "</td><td>";
            $res .= $interest . "%";
            $res .= "</td></tr>";
         }   
         echo $res;
         $stmt->close();
      }
      $conn->close();
   }
   function cidExists($cid) {
      require("database.php");
      $sql = "SELECT cid FROM Clients c
              WHERE c.cid = ?";

      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("i", $cid);
         $stmt->execute();
         $stmt->bind_result($db_cid);
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


   function createNewAccount($owner_id, $acc_type) {
      require("database.php");

      $_SESSION['error'] = 0;
     
      $sql = "INSERT INTO Accounts VALUES";
      $sql .= " (NULL, ?, ?, 0)";
      
      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("ii", $owner_id, $acc_type);
         $stmt->execute();
      } else {
         $_SESSION['error'] = 1;
      }
      $stmt->close();
      $conn->close();
   }

   function searchUser($string) {
      require("database.php");
      $sql = "SELECT username, l.cid, fname, lname ";
      $sql .= " FROM Login l";
      $sql .= " JOIN Clients c";
      $sql .= " ON l.cid = c.cid";
      $sql .= " WHERE lname like ?";
      $sql .= " OR fname like ?";
      $sql .= " OR username like ?";

      $string = "%". $string ."%";
      if( $stmt = $conn->prepare($sql) ) {
         $stmt->bind_param("sss", $string, $string, $string);
         $stmt->execute();
         $stmt->bind_result($username, $cid, $fname, $lname);
         echo "<tr class='danger'>";
         echo "<th>Username</th>";
         echo "<th>Client ID</th>";
         echo "<th>First Name</th>";
         echo "<th>Last Name</th>";
         echo "</tr>";
         $res = "";
         while ( $stmt->fetch() ) {
            $res .= "<tr class='active'><td>";
            $res .= $username;
            $res .= "</td><td>";
            $res .= $cid;
            $res .= "</td><td>";
            $res .= $fname;
            $res .= "</td><td>";
            $res .= $lname;
            $res .= "</td></tr>";
         }   
         echo $res;
         $stmt->close();
      }

      $conn->close();

   }
