<?php
   session_start();
   if( !isset($_SESSION['username']) ) {
      header('location:index.php');
   } 

?>
<?php
   require("navbar.php");
?>

<h1>Gateway<h1>
<button id="clear">Clear</button>
<button id="update">Update</button>
<br><br>
<div id="binfo"></div>
<script>
$(document).ready(function() {
   $("#update").click(function() {
      $("#binfo").load("summary.php");
   });
   $("#clear").click(function() {
      document.getElementById("binfo").innerHTML="";
   });
});
</script>
