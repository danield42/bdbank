<link rel="stylesheet" type="text/css" href="css/welcome.css">
<h1>Welcome!</h1>

<p id="welcome_msg">
<?php
   $file = file_get_contents('welcome.txt');
   echo $file;
?>
</p>
<div class="login_container">
<form id="login_form" action="login.php" method="POST">
   <input type="text" name="username" placeholder="Username" required><br>
   <input type="password" name="pword" placeholder="Password" required><br>
   <input type="submit" value="Login">
</form>
   <button id="reg">Register</button>
</div>
<script>
   $(document).ready(function() {
      $("#reg").click(function() {
         $("#content").load("register.php");
      });
   });
</script>
