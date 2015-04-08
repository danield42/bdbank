<?php 
   session_start();
   if (isset($_SESSION['username'])) {
      header("Location:index.php");
   }
   include("functions.php");
   include("header.php");
?>

    <!-- Put your page content here! -->
    <div class="col-md-6 col-md-offset-3">
      <div class="jumbotron">
   
        <h2 class="text-center">Registration Successful!</h2>
        <p class="text-center">You can now log in:</p><br>
        <p class="text-center"><a class="btn btn-primary btn-lg" href="login.php" role="button">Login</a>
        </p>
      </div>
    </div>

<?php
   include("footer.php");
?>


