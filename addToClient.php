<?php
   session_start();
   include("functions.php");
   if(isset($_POST['owner_id']) && isset($_POST['acc_type'])) {
      if( cidExists($_POST['owner_id'])) {
         createNewAccount($_POST['owner_id'], $_POST['acc_type']);
         if( $_SESSION['error'] == 1 ) {
            header("Location: addNewAccount.php?success=0");
         } else {
            header("Location: addNewAccount.php?success=1");
         }
      }
   }

?>
