<?php 
  error_reporting(0);
  $path2root = ".";
  if (isset($_POST['login'])) {
    session_start();
    $username = trim($_POST['username']);
    $password = trim($_POST['pwd']);
    $_SESSION['username'] = $username;
    // location to redirect on success
    $redirect = '/user/index.php';
    require_once("$path2root/assets/inc/authenticate.inc.php");
  }
  ob_start();
  try {
  include("$path2root/assets/inc/title.inc.php"); 
  include("$path2root/assets/inc/logout.inc.php");
?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="log_in">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>
<div class="container-fluid">
  <div class="hero-unit">
    <div class="row">
      <div class="span6">
        <h3>Log Into your Account:</h3>
        <br />
        <?php
        if ($error) {
          echo "<p>$error</p>";
        } elseif (isset($_GET['expired'])) {
        ?>
        <p>Your session has expired. Please log in again.</p>
        <?php } ?>
        <form id="form1" method="post" action="">
          <p>
              <label for="username">Username:</label>
              <input type="text" name="username" id="username">
          </p>
          <p>
              <label for="pwd">Password:</label>
              <input type="password" name="pwd" id="pwd">
          </p>
          <p>
              <input class="btn btn-large" name="login" type="submit" id="login" value="Log in">
          </p>
        </form>
      </div><!-- .span -->
      <div class="span4">
        <h3>Dont have an account yet?</h3>
        <br />
        <a class="btn btn-large btn-info" href="/sign_up.php" title="Sign Up for Biindle.com">Sign up!</a>
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