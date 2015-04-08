<?php
   include("header.php")
?>

<div class="col-md-6 col-md-offset-3">
   <div class="jumbotron">
      <h1 class="text-center">You were warned</h1>
   </div>
</div>


<video autoplay loop poster="img/heyyy.gif" id="bgvid">
   <source src="vid/heyyy.mp4" type="video/mp4">
</video>

<script>
$(document).ready(function(){
      $('#bgvid').bind('contextmenu',function() { return false; });
});
</script>
<?php
   include("footer.php")
?>
