<?php 
  $path2root = ".";
  session_start();
  ob_start();
  if (isset($_SESSION['authenticated'])) {
    include("$path2root/assets/inc/user_funcs.inc.php");
    $username = $_SESSION['username'];
    // create database connection
    require_once("$path2root/assets/inc/connection.inc.php");
    $conn = dbConnect('read');
    $sql = "SELECT * FROM users WHERE username = '".$username."'";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    $row = $result->fetch_assoc(); 
    $user_id = $row['user_id'];
  } 
  try {
  include("$path2root/assets/inc/title.inc.php");   
  // user authentication
  if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['pwd']);
    $retyped = trim($_POST['conf_pwd']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    require_once("$path2root/assets/inc/register_user.inc.php");
  }
?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="sign_up">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>
<div class="container-fluid">
  <div class="hero-unit">
    <div class="row">
      <div class="span5">
        <h1>Fill in the fields:</h1>
        <br />
        <?php
        if (isset($success)) {
          echo "<p>$success</p>";
        } elseif (isset($errors) && !empty($errors)) {
          echo '<ul>';
          foreach ($errors as $error) {
          echo "<li>$error</li>";
          }
          echo '</ul>';
        }
        ?>
        <form id="sign_up" method="post" action="">
          <p>
            <label for="username">Username:</label>
            <input name="username" type="text" id="username">
          </p>
          <p>
            <label for="pwd">Password:</label>
            <input name="pwd" type="password" id="pwd">
          </p>
          <p>
            <label for="conf_pwd">Retype-Password:</label>
            <input name="conf_pwd" type="password" id="conf_pwd">
          </p>
          <p>
            <label for="first_name">First Name:</label>
            <input name="first_name" type="text" id="first_name">
          </p>
          <p>
            <label for="last_name">Last Name:</label>
            <input name="last_name" type="text" id="last_name">
          </p>
          <p>
            <label for="email">Email:</label>
            <input name="email" type="text" id="email">
          </p>
          <p>
            <button class="btn btn-large btn-primary" type="submit" name="register" id="register" onClick="">&nbsp;&nbsp;Sign Up&nbsp;&nbsp;</button>
          </p>
        </form>
      </div><!-- .span -->
      <div class="span5">
        <h3>Already have an account?</h3>
        <br />
        <a class="btn btn-large btn-info" href="log_in.php">Log In</a>
      </div><!-- .span -->
    </div><!-- .row -->
  </div><!-- .hero-unit -->
</div><!-- .container -->

<!-- ### Success Modal ### -->
<div id="login_success" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Welcome to Biindle!</h3>
  </div>
  <div class="modal-body">
    <h4>Great Work!</h4>
    <p>You are now a coveted member of the exclusive, quality driven travel website, Biindle.  Please log-in now, so you can start customizing your Biindle experience.</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <a href="log_in.php" class="btn btn-primary">Log In</a>
  </div>
</div>

<?php include("$path2root/assets/inc/footer.inc.php"); ?>
<script type="text/javascript">
  (function($) {
    $(document).ready(function() {

      // Handle Sign-up form
      $('#sign_up').submit(function() {
        var username = $('#username').val(),
            pwd = $('#pwd').val(),
            conf_pwd = $('#conf_pwd').val(),
            first_name = $('#first_name').val(),
            last_name = $('#last_name').val(),
            email = $('#email').val();
        
        console.log(username + " \n" + pwd + " \n" + conf_pwd + " \n" + first_name + " \n" + last_name + " \n" + email);

        var dataString = 'register=1&username='+username+'&pwd='+pwd+'&conf_pwd='+conf_pwd+'&first_name='+first_name+'&last_name='+last_name+'&email='+email;
        console.log(dataString);

        $.ajax({
          beforeSend: function() {
            console.log("Preparing communications...");
          },
          type: "POST",
          url: "/assets/inc/register_user.inc.php",
          data: dataString,
          success: function(data){
            console.log("Success!");
          },
          complete: function(){
            $('#login_success').modal('show');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log("There appears to have been an error:\n\n"+errorThrown);
          }
        }); // $.ajax()

        return false;

      }); // $('#sign_up').submit()

    }); // $(document).ready()
  })(jQuery);
</script>
</body>
</html>
<?php
  } catch (exception $e) {
    ob_end_clean();
    header("Location: $path2root/error.php");
  }
  ob_end_flush();
?>