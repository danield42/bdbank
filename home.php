<?php
   session_start();
   if( !isset($_SESSION['username']) ) {
      header('location:index.php');
   } 

?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/navbar.css">
<script src="js/jquery-1.11.2.min.js"></script>
<script>
$(document).ready(function() {
   $("#content").load("summary.php");
});
</script>
</head>

<body>
<?php
   require("navbar.php");
?>
<div id="content">
</div>
</body>
</html>
