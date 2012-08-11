<?php 
  $path2root = "..";
  require_once("$path2root/assets/inc/session_timeout.inc.php");
  try {
  include("$path2root/assets/inc/title.inc.php");
  include("$path2root/assets/inc/logout.inc.php"); 

  $username = $_SESSION['username'];

  if (isset($_POST['update'])) {
    $email = trim($_POST['email']);
    $website = trim($_POST['website']);
    $about = trim($_POST['about']);
    $user = trim($_POST['user']);
    require_once("$path2root/assets/inc/update_user.inc.php");
  }
  if (isset($_POST['update_pass'])) {
    $password = trim($_POST['pwd']);
    $retyped = trim($_POST['conf_pwd']);
    require_once("$path2root/assets/inc/update_password.inc.php");
  }

?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="user_settings">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
      <div class="well">
        <?php include("$path2root/assets/inc/usermenu.inc.php"); ?>
      </div>
    </div>
    <div class="span9">
        <div class="row-fluid">
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
          <form class="well form-horizontal" id="form1" method="post" action="">
            <h4>Update your password</h4>
            <br />
            <p>
              <label for="pwd">Password:</label>
              <input name="pwd" type="password" id="pwd">
            </p>
            <p>
              <label for="conf_pwd">Retype-Password:</label>
              <input name="conf_pwd" type="password" id="conf_pwd">
            </p>
            <p>
              <button class="btn btn-success" type="submit" name="update_pass" id="update_pass">Update Password</button>
            </p>
          </form>
          <br />
          <form class="well form-horizontal" id="form2" method="post" action="">
            <h4>Change your email address</h4>
            <br />
            <p>
              <label for="email">Email:</label>
              <input name="email" type="text" id="email">
            </p>
            <h4>Provide your blog or website address</h4>
            <br />
            <p>
              <label for="website">www.yoursite.com</label>
              <input name="website" type="text" id="website">
            </p>
            <h4>Tell us a little about yourself</h4>
            <br />
            <p>
              <label for="about">About</label>
              <textarea name="about" id="about" rows="10"></textarea>
            </p>
            <p>
              <input type="hidden" name="user" id="user" value="<?php echo $username; ?>" />
              <button class="btn btn-primary" type="submit" name="update" id="update">Update Settings</button>
            </p>
          </form>
        </div><!-- .row -->
    </div><!-- span -->
  </div><!-- row -->
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