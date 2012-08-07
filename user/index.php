<?php 
  $path2root = "..";
  require_once("$path2root/assets/inc/session_timeout.inc.php");
  try {
  include("$path2root/assets/inc/title.inc.php"); 
  include("$path2root/assets/inc/user_agent.php");
?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="blank">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>
<div class="container">
  <div class="row">
    <div class="span3">
      <div class="well">
        <ul class="nav nav-pills nav-stacked">
          <li><a href="#">Account Settings</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Messages</a></li>
        </ul>
      </div>
    </div>
    <div class="span9">
      <div class="hero-unit">
        <h1>Restricted area</h1>
        <?php echo ""; ?>
        <p><a href="menu_db.php">Another Restricted Page</a></p>
        <?php include("$path2root/assets/inc/logout.inc.php"); ?>
      </div>
    </div>
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