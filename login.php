<?php 
   include("functions.php");
   include("header.php");
   require("login_validate.php");
   
   $lv = new loginValidate();
   $err = $lv->get_error();
   if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $lv->userLogin($_POST['username'], $_POST['password']);
      $err = $lv->get_error();
   }
?>

    <!-- Put your page content here! -->
    <div class="col-md-6 col-md-offset-3">
        <div class="jumbotron">
            <form class="form-horizontal" action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
              <?php if($err  == 1) { ?>
                <div class="alert alert-danger" role="alert">Your login information was incorrect. Please try again.</div>
              <?php } ?> 
                <div class="form-group">
                    <label for="loginUsername" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" id="loginUsername" placeholder="Username" value="<?php echo $_POST['username']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="loginPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Password" value="" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" onclick="document.location = 'index.php';">Back</button>
                        <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
   include("footer.php");
?>


