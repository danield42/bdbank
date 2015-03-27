<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" media="screen and (max-width: 320px)" href="css/mobile_style.css">
<script src="js/jquery-1.11.2.min.js"></script>
<?php
   require("navbar.php");
?>
</head>

<body>
<div id="content"></div>
<script>
$(document).ready(function() {
<?php
   if( !isset($_SESSION['username']) ) {
?>
      $("#content").load("welcome.php");
<?php
   } else {
?>
      $("#content").load("gate.php");
<?php } ?>
});
</script>
</body>
</html>
