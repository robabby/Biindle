<?php 
  $path2root = "..";
  require_once("$path2root/assets/inc/session_timeout.inc.php");
  try {
  include("$path2root/assets/inc/title.inc.php"); 
  require_once("$path2root/assets/inc/connection.inc.php");

  $username = $_SESSION['username'];

  // create database connection
  $conn = dbConnect('write');
  $sql = "SELECT * FROM users WHERE username = '".$username."'";
  $result = $conn->query($sql) or die(mysqli_error($conn));
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
        <?php while($row = $result->fetch_assoc()) { ?>
        <h1><?php echo "Hey there, " . $_SESSION['username'] . "!";?></h1>
        <p>Welcome to your Biindle</p>
        <p><?php echo $row['first_name'] . " " . $row['last_name']; ?></p>
        <?php } // End of while loop ?>
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