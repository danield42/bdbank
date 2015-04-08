<?php 
   session_start();
   if(!isset($_SESSION['username'])) {
      header("Location: index.php");
   } else { 
      include("functions.php");
      if (isEmployee($_SESSION['username']) == 0) {
         header("Location: index.php");
      }
      include("header2.php");

?>
<div id="wrapper" class="toggled">
<?php
     if (isEmployee($_SESSION['username']) == 1) 
        $emp = 1;
        include("employee_tools.html");
?>

 <div id="page-content-wrapper">
<?php if($emp == 1) { ?>
  <button id="toggle_emp_tools" class="btn btn-danger">Tools</button>
<?php } ?>
    <div class="container-fluid">
        <div class="jumbotron tall">
         <div class="page-header">
           <h1>Create new account</h1>
           <p>Please enter the following information to add a new account to a client:</p>
   <?php if(isset($_GET['success'])) {
            if( $_GET['success'] == 1) { ?>
            <h3><span class="alert alert-success">Account creation successful!</span></h3>
   <?php    } else { ?>
            <h3><span class="alert alert-success">Something went wrong when creating the account. No guarantees!</span></h3>
   <?php    }
         } ?>
         </div>
         <form class="form-inline" action="addToClient.php" method="POST">
         <div class="row">
         <div class= "col-md-6 col-md-offset-3">
            <input type="number" class="form-control" id="owner_id" name="owner_id" placeholder="Client ID" min=1 required>
         </div>
         </div>
         <div class="row">
         <div class= "col-md-6 col-md-offset-3">
            <select name="acc_type" id="acc_type" class="form-control input-md" required >
               <option value="">Please choose an option below.</option>
               <option value=1>1: Student Chequings</option>
               <option value=2>2: Chequings</option>
               <option value=3>3: Youth Savings</option>
               <option value=4>4: High-Interest Savings</option>
           </select>
         </div>
         </div>
         <br>
         <div class="row">
           <div class= "col-md-6 col-md-offset-3">
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </div>
         </div>
        </form>
           <table id="acc_table" class="table-bordered table-hover">
         <?php getAccountTypes(); ?>
           </table>
        </div>
    </div>
 </div>
</div>
<?php
      include("footer.php");
   }
?>
<script>
$(document).ready(function() {
    $("#toggle_emp_tools").click(function() {
       $("#wrapper").toggleClass("toggled");
    });
});
</script>

