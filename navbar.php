<?php
   session_start();
?>
<link rel="stylesheet" type="text/css" href="css/navbar.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" media="screen and (max-width: 320px)" href="css/mobile_navbar.css">

<script>
$(document).ready(function() {
   $("#home").click(function() {
      window.location.href = "home.php";
   });
<?php if( isset($_SESSION["username"]) ) { ?>
   $("#logout_btn").click(function() {
      window.location.href = "logout.php";
   });
<?php } ?>
});

</script>

<div class="bdbanner">
<a href="index.php"><img src="img/logo0.png" id="logo" alt="logo"></a>
<div class="nav_container">
<ul id="navbar">
   <li><a href="home.php"><button id="home">Home</button></a></li>
<!--
   <li><button id="nothome">NotHome</button></li>
-->
<?php if( isset($_SESSION["username"]) ) { ?>
   <li><a href="logout.php"><button id="logout_btn">Logout</button></a></li>
<?php } ?>
</ul>
</div>

<?php if( !isset($_SESSION['username']) ) { ?>
<div id="login_container">
   <form id="login_form" action="login.php" method="POST">
   <input type="text" name="username" placeholder="username" required>
   <input type="password" name="pword" placeholder="password" required>
   <input type="submit" value="Login">
   </form>
</div>
<?php } ?>
</div><!--end nav_container-->

</div><!--end bdbanner-->
