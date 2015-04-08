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

   //1 for deposit, 2 for withdraw
      $_SESSION['trans_type'] = 2;


?>
<div id="wrapper" class="toggled">
<?php
        include("employee_tools.html");

?>

 <div id="page-content-wrapper">
  <button id="toggle_emp_tools" class="btn btn-danger">Tools</button>
    <div class="container-fluid">
        <div class="jumbotron tall">
         <div class="page-header">
           <h1>Withdraw</h1>
      <?php if( isset($_POST['acc_num']) && $_GET['p'] == 2 ) {
               if( validAccount($_POST['acc_num']) == 0 ) { ?>
                  <p>That account does not exist. Please go back and enter a proper account number.</p>
                  <button class="btn btn-primary" onclick="document.location='withdraw.php?p=1';">Back</button>
         <?php } else {
           $_SESSION['acc_num'] = $_POST['acc_num']; ?>
           <p>Enter the amount to withdraw (Min $1, max $2500)</p>
           <form class="form-inline" action="withdraw.php?p=3" method="POST">
            <div class="form-group">
              <label class="sr-only" for="amount">Amount</label>
              <div class="input-group">
              <div class="input-group-addon">$</div>
              <input type="number" class="form-control" min="1" step="0.01" max="2500" name="amount" placeholder="Amount" required>
              </div>
              <input type="submit" class="btn btn-primary" value="Next">
            </div>
           </form>
     <?php }} else if (isset($_POST['amount']) && $_GET['p'] == 3) { 
           $_SESSION['amount'] = $_POST['amount']; ?>
           <div class="alert alert-warning" role="alert">
              <p>Account Number: <?php echo $_SESSION['acc_num'];?></p>
              <p>Withdraw Amount: <?php echo $_SESSION['amount'];?></p>
           </div>
              <p>Is this information correct?</p>
              <form class="form-inline" action="transaction.php" method="POST">
                 <input type="checkbox" name="agree" value="1" required> I agree to the previous information.
                 <input type="submit" class="btn btn-primary" value="Submit">
              </form>

     <?php } else { ?>
           <p>Enter the account number from where you would like to withdraw money.</p>
           <form action="withdraw.php?p=2" method="POST">
           <div class="form-group">
              <input type="number" id="acc_num" name="acc_num" placeholder="Account Number" min=1 required>
              <input type="submit" class="btn btn-primary" value="Next">
           </div>
           </form>
     <?php } ?>
         </div>
       </div>
    </div>
 </div>
</div>
<script>
$(document).ready(function() {
    $("#toggle_emp_tools").click(function() {
       $("#wrapper").toggleClass("toggled");
    });
});
</script>
<?php
      include("footer.php");
   }
?>

