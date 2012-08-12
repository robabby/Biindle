<?php 
  $path2root = ".";
  session_start();
  ob_start();
  if (isset($_SESSION['authenticated'])) {

    include("$path2root/assets/inc/user_functions.inc.php");
    
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

?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="home">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>

<div class="container-fluid">
  <div class="hero-unit">
    <h1>More eyes to see the world</h1>
    <br />
    <br />
    <a class="btn btn-large btn-primary" href="sign_up.php" title="#">Sign Up Now</a>
  </div>
  <div class="alert alert-info">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">Guess what...</h4>
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
          echo "\nAnd you are running Android";
      }
      if (!$detect->isMobile() && !$detect->isTablet()) {
          echo "You are viewing this site with a Computer!";
      }
    ?>
  </div>
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