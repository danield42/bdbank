    <!-- Navigation -->
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
             <?php if (isset($_SESSION['username'])) {
                     if (isEmployee($_SESSION['username']) == 1) { ?>
                <a class="navbar-brand" href="employee.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></    span>Employee</a>
             <?php }} ?> 

             <?php if (isset($_SESSION['username'])) { ?>
                <p class="navbar-text">Signed in as <?php echo $_SESSION['username']; ?></p>
             <?php } ?>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="summary.php">Summary</a>
                    </li>
                    <li>
                        <a href="heyyy.php">Don't click me</a>
                    </li>
                    <li>
            <?php if (isset($_SESSION['username'])) { ?>
                        <a href="logout.php">Logout <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
            <?php } else { ?>
                        <a href="login.php"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login</a>
                    </li>
                    <li>

                        <a href="register.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register</a>
            <?php } ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
