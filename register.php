<link rel="stylesheet" type="text/css" href="css/register.css">
<h1>Register</h1>
<button id="back">Back</button>
<div class="reg_container">
<form id="reg_form">
   <input type="text" id="accnum" placeholder="Account number" required><br>
   <label id="invalid_accnum">account number invalid<br></label> 
   <input type="text" id="username" placeholder="Username" required><br>
   <label id="invalid_uname">username invalid<br></label>
   <input type="password" id="pword" placeholder="Password 6-9 characters" required><br>
   <label id="invalid_pword">password invalid<br></label>
   <input type="password" id="pmatch" placeholder="Confirm password" required><br>
   <label id="invalid_pmatch">passwords do not match<br></label>
   <input type="email" id="email" placeholder="example@example.com" required><br>
   <label id="invalid_email">email invalid<br></label>
   <input id="reg_submit" type="submit">
</form>
</div>
<script>
   var chk = [0,0,0,0,0];
   $(document).ready(function() {
      $("#back").click(function() {
         $("#content").load("welcome.php");
      });


      //validate input
      $('#reg_submit').attr('disabled', 'disabled');
      $("#username").on('blur', function() {
         var regex = /^[a-zA-Z0-9]{3,12}$/i;
         if( regex.test(this.value) ) {
            $(this).css("background-color", "white");
            $("#invalid_uname").hide();
            chk[0] = 1;
         } else {
            $(this).css("background-color", "#faa");
            $("#invalid_uname").show();
            chk[0] = 0;
         }
      });
      $('#pword').on('blur', function() {
         var regex = /^.{6,9}$/;
         if( regex.test(this.value) ) {
            $(this).css("background-color", "white");
            $("#invalid_pword").hide();
            chk[1] = 1;
         } else {
            $(this).css("background-color", "#faa");
            $("#invalid_pword").show();
            chk[1] = 0;
         }
      });
      $('#pmatch').on('blur', function() {
         var regex = /^.{6,9}$/;
         if( regex.test(this.value) &&
             $(this).val() == $('#pword').val() ) {
            $(this).css("background-color", "white");
            $("#invalid_pmatch").hide();
            chk[2] = 1;
         } else {
            $(this).css("background-color", "#faa");
            $("#invalid_pmatch").show();
            chk[2] = 0;
         }
      });
      $('#email').on('blur', function() {
         var regex = /^[a-zA-z0-9]+@[a-zA-Z]+.[a-zA-Z]{2,8}$/i;
         if( regex.test(this.value) ) {
            $(this).css("background-color", "white");
            $("#invalid_email").hide();
            chk[3] = 1;
         } else {
            $(this).css("background-color", "#faa");
            $("#invalid_email").show();
            chk[3] = 0;
         }
      });
      $('#accnum').on('blur', function() {
         var regex = /^[1-9][0-9]{0,8}$/i;
         if( regex.test(this.value) ) {
            $(this).css("background-color", "white");
            $("#invalid_accnum").hide();
            chk[4] = 1;
         } else {
            $(this).css("background-color", "#faa");
            $("#invalid_accnum").show();
            chk[4] = 0;
         }
      });
      $('input').blur(function() {
         if( 1 == chk[0] && 1 == chk[1] && 1 == chk[2] && 1 == chk[3] && 1 == chk[4] ) {
            $('#reg_submit').removeAttr('disabled');
         }
          else {
            $('#reg_submit').attr('disabled', 'disabled');
         }
      });
   });
</script>
