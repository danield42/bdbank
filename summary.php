<?php 
   session_start();
   if(!isset($_SESSION['username'])) {
      header("Location: index.php");
   } else { 
      include("functions.php");
      include("header2.php");
?>
<div id="wrapper">
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="jumbotron tall">
        <div class="page-header">
           <h1>Summary<small><p class="text-center">Welcome, <?php getname($_SESSION['username']);?>.</p></small></h1>
      <?php if (isset($_GET['aid'])) { 
               if( username_owns($_SESSION['username'], $_GET['aid']) == 1 ) { ?>
           <p>Showing information for account <?php echo "<" . $_GET['aid'] . ">"; ?></p>
        </div>
        <table class ="table-striped" id="table_history"><?php gethistory($_GET['aid']);?></table>
         <?php } else { ?>
               <p>You do not have access to this account. Shame on you.</p>
               </div>
         <?php }
            } else { ?>
            <p>Here's a list of your accounts. Click on any of the rows to view the account's recent transaction history:</p>
            </div> 
            <table class ="table-striped" id="table_accounts"><?php getaccounts($_SESSION['username']);?></table>
      <?php } ?>
        </div>
    </div>
</div>
</div>
<?php
      include("footer.php");
   }
?>
