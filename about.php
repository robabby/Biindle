<?php 
  $path2root = ".";
  session_start();
  ob_start();
  if (isset($_SESSION['authenticated'])) {
    include("$path2root/assets/inc/user_funcs.inc.php");
    $username = $_SESSION['username'];
  } 
  
  try {
  include("$path2root/assets/inc/title.inc.php"); 
?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="blank">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>

<div class="container">
  <div class="hero-unit">
    <h2>About Biindle</h2>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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