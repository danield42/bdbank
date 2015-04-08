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
        include("employee_tools.html");

?>

 <div id="page-content-wrapper">
  <button id="toggle_emp_tools" class="btn btn-danger">Tools</button>
    <div class="container-fluid">
        <div class="jumbotron tall">
         <div class="page-header">
           <h1>Client Lookup</h1>
         </div>
         <form class="form-horizontal" action="" method="POST">
         <div class="form-group">
             <div class="input-group">
              <input type="text" id="lookup" name="lookup" class="form-control" placeholder="Search for..." required value="<?php echo $_POST['lookup']; ?>">
              <span class="input-group-addon">Search</span>
             </div>
              <input type="submit" class="btn btn-primary" value="Search">
          </div>
         </form>
         <table id="acc_table" class="table-hover table-border">
<?php   if( $_SERVER['REQUEST_METHOD'] == 'POST') {
      searchUser($_POST['lookup']);
   } ?>  </table>

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

