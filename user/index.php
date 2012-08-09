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
        <?php include("$path2root/assets/inc/usermenu.inc.php"); ?>
      </div>
    </div>
    <div class="span9">
      <div class="hero-unit">
        <?php while($row = $result->fetch_assoc()) { ?>
        <h1><?php echo "Hey there, " . $row['first_name'] . " " . $row['last_name'] . "!";?></h1>
        <br />
        <h2>Welcome to your Biindle</h2>
        <p><span class="label label-info">Member since: <?php echo $row['created']; ?></span>
        <br />
        <?php include("$path2root/assets/inc/logout.inc.php"); ?>
        <?php } // End of while loop ?>
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