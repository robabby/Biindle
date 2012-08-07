<?php 
  $path2root = ".";
  ob_start();
  try {
  include("$path2root/assets/inc/title.inc.php"); 
  include("$path2root/assets/inc/user_agent.php");
  require_once("$path2root/assets/inc/connection.inc.php");
?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="home">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>

<div class="container">
  <div class="hero-unit">
    <h1>More eyes to see the world</h1>
    <br />
    <a class="btn btn-large btn-inverse" href="sign_up.php" title="#">Sign Up Now</a>
  </div>
  <pre>
    <?php
      if ($detect->isMobile() && !$detect->isTablet()) {
          echo "You are viewing this site with a Smartphone!";
      } 
      if ($detect->isTablet() && $detect->isMobile()) {
          echo "You are viewing this site with a Tablet!";
      } 
      if($detect->isiOS()){
          echo "And you are running iOS";
      }
      if($detect->isAndroidOS()){
          echo "And you are running Android";
      }
      if (!$detect->isMobile() && !$detect->isTablet()) {
          echo "You are viewing this site with a Computer!";
      }
    ?>
  </pre>
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