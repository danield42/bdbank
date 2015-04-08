<?php 
   include("functions.php");
   include("header.php");
?>

    <!-- Put your page content here! -->
    <div class="col-md-6 col-md-offset-3">
        <div class="jumbotron">
   
   <?php if(!isset($_SESSION['username'])) { ?>
        <h2 class="text-center">Welcome to BD Bank!</h2>
        <p class="text-center">It appears you aren't logged in.<br>Please log in, or register for a new account</p><br>
        <p class="text-center"><a class="btn btn-primary btn-lg" href="login.php" role="button">Login</a>
           <a class="btn btn-primary btn-lg" href="register.php" role="button">Register</a>
        </p>
   
   <?php } else { ?>
        <h2 class="text-center">Welcome, <?php echo $_SESSION['username'];?>.</h2>
        <p class="text-center"> Click below to view your account summary</p>
        <a href="summary.php"><button type="button" class="btn btn-primary">Summary</button></a>
   <?php } ?>
        </div>
    </div>

<?php
   include("footer.php");
?>


