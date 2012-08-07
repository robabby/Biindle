<?php 
  $path2root = ".";
  ob_start();
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
<div class="container">
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
        <form id="form1" method="post" action="">
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
            <button class="btn btn-large btn-primary" type="submit" name="register" id="register">&nbsp;&nbsp;Sign Up&nbsp;&nbsp;</button>
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
<?php include("$path2root/assets/inc/footer.inc.php"); ?>
</body>
</html>
<?php
  } catch (exception $e) {
    ob_end_clean();
    header("Location: $path2root/error.php");
  }
  ob_end_flush();
?>