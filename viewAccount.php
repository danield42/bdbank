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
           <h1>View Account Summary</h1>
      <?php if(isset($_GET['acc_num'])) { ?> 
            <button class="btn btn-primary" onclick="document.location='viewAccount.php';">Back</button>
            <h3>For Account #<?php echo $_GET['acc_num']; ?></h3>
            <h3>Name: <?php getnameAcc($_GET['acc_num']); ?></h3>
            <h3>Balance: $<?php balance($_GET['acc_num']); ?></h3>
            <table class ="table-striped" id="table_history">
         <?php gethistory($_GET['acc_num']);?>
            </table>
      <?php } else { ?>
           <p>Enter the account for which you want to see a recent transaction history.</p>
           <form class="form-inline" action="viewAccount.php" method="GET">
            <div class="form-group">
             <div class="input-group">
               <input type="number" name="acc_num" min=1 placeholder="Account #" required>
               <input type="submit" class="btn btn-primary" name="submit" value="Go">
             </div>
            </div>
           </form>
      <?php } ?>
         </div>
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

