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
           <h1>Employee Tools</h1>
           <p>Either use the tools in the sidebar, or click one of the options below:</p>
         </div>
         <div class="row">
              <div class="list-group">
               <a class="list-group-item list-group-item-danger" href="viewAccount.php">View Account Summary</a>
               <a class="list-group-item list-group-item-danger" href="withdraw.php">Withdraw Money</a>
               <a class="list-group-item list-group-item-danger" href="deposit.php">Deposit Money</a>
               <a class="list-group-item list-group-item-danger" href="addNewAccount.php">Add Account to Client</a>
               <a class="list-group-item list-group-item-danger" href="clientLookup.php">Search for a client</a>
              </div>
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

