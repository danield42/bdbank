<?php 
   include("functions.php");
   include("header.php");
   require("reg_validate.php");

   if( isset($_SESSION['username'])) {
      header("Location: index.php");
   }
   
   $reg = new regValidate();
   $reg_err = $reg->get_error();
   if($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($_POST['regPassword'] == $_POST['regPasswordConfirm']) {
         $reg->userRegister($_POST['regUsername'], $_POST['regPassword'], $_POST['regEmail'], $_POST['firstName'], $_POST['lastName'], $_POST['phonenumber']);
         $reg_err = $reg->get_error();
      } else {
         $reg_err = 1;
      }
   }
?>

    <div class="col-md-6 col-md-offset-3">
        <div class="jumbotron">
            <h2>Register</h2>
            <form class="form-horizontal" action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
              <?php if($reg_err  == 1) { ?>
                <div class="alert alert-danger" role="alert">There was one or more fields entered incorrectly. Please try again.</div>
              <?php } ?> 
                <div class="form-group">
                    <label for="regUsername" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="regUsername" id="regUsername" placeholder="Username" value="<?php echo $_POST['regUsername']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="regEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="regEmail" id="regEmail" placeholder="Email" value="<?php echo $_POST['regEmail'];?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" value="<?php echo $_POST['firstName'];?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastName" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" value="<?php echo $_POST['lastName'];?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phonenumber" class="col-sm-2 control-label">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" maxlength="11" class="form-control" name="phonenumber" id="phonenumber" placeholder="Phone" value="<?php echo $_POST['phonenumber'];?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="regPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="regPassword" id="regPassword" placeholder="Password" value="<?php echo $_POST['regPassword'];?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="regPasswordConfirm" class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="regPasswordConfirm" id="regPasswordConfirm" placeholder="Confirm Password" value="" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" onclick="document.location = 'index.php';">Back</button>
                        <button type="submit" class="btn btn-default">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
   include("footer.php");
?>


