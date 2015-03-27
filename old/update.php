<?php
include "database.php";
echo "Trying...<br>";
if ($conn) {
echo "Meow<br>";
//list all Clients and their respective bank accounts (if applicable)
     $sql = "SELECT * from Clients";
//   $sql = "SELECT CONCAT_WS(' ', fname, lname) AS full_name, cid, acc_id, acc_type 
           FROM Clients c
           LEFT JOIN Accounts a
           ON c.cid = a.owner_id";
   $result = mysqli_query($conn,$sql);
/*   echo "<table><tr>";
      echo "<th>Name</th>";
      echo "<th>Client No.</th>";
      echo "<th>Account No.</th>";
      echo "<th>Account Type</th>";
   echo "</tr>";
*/
   while($row = $mysqli_fetch_assoc($result)) {
      echo "<tr><td>" . $row['full_name'] . "</td><td>" . $row['cid'] . "</td><td>" . $row['acc_id'] . "</td><td>" . $row['acc_type'] . "</td></tr>";
   }
   echo "</table>";
} else {
   echo "0 Results.";
}
mysqli_close($conn);
?>
