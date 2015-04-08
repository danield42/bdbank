<?php 
   session_start();
   if(!isset($_SESSION['username'])) {
      header("Location: index.php");
   } else { 
      include("functions.php");
      if (isEmployee($_SESSION['username']) == 0)  {
         header("Location: index.php");
      }
      if (!isset($_SESSION['acc_num'])) {
         header("Location: employee.php");
      }
      include("header2.php");

   //1 deposit
   //2 withdraw
      if( $_SESSION['trans_type'] == 1) {
         deposit($_SESSION['acc_num'], $_SESSION['amount']);
      } else { 
         withdraw($_SESSION['acc_num'], $_SESSION['amount']);
      }
?>
<div id="wrapper" class="toggled">

 <div id="page-content-wrapper">
  <button id="toggle_emp_tools" class="btn btn-danger">Tools</button>
    <div class="container-fluid">
        <div class="jumbotron tall">
         <div class="page-header">
           <h1>Transaction Status<h1>
      <?php if ($_SESSION['error'] == 1) { ?>
               <h3>Transaction failed. Please try again later.</h3>
      <?php } else { ?>
               <h3>Transaction succeeded! New balance is: $<?php balance($_SESSION['acc_num']); ?></h3>

      <?php }
            unset($_SESSION['acc_num']);
            unset($_SESSION['amount']);
            unset($_SESSION['trans_type']);
            unset($_SESSION['error']);
       ?>
           <p>Either use the tools in the sidebar, or click one of the options below:</p>
         </div>
         <div class="row">
            <div class="col-md-12">
               <button class="alert alert-info" onclick="document.location = 'employee.php';">Back to Employee Page</button>
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

