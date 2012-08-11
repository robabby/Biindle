<?php 
  $path2root = "..";
  require_once("$path2root/assets/inc/session_timeout.inc.php");

  $username = $_SESSION['username'];
  try {
  include("$path2root/assets/inc/title.inc.php"); 
  include("$path2root/assets/inc/user_functions.inc.php");
  include("$path2root/assets/inc/logout.inc.php");
  require_once("$path2root/assets/inc/connection.inc.php");

  // create database connection
  $conn = dbConnect('read');
  $sql = "SELECT * FROM users WHERE username = '".$username."'";
  $result = $conn->query($sql) or die(mysqli_error($conn));
?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="user">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
      <div class="well">
        <?php include("$path2root/assets/inc/usermenu.inc.php"); ?>
      </div>
    </div>
    <div class="span9">
      <div class="well">
        <?php while($row = $result->fetch_assoc()) { ?>
        <?php if (file_exists("$path2root/user/images/$username.jpg"))
          echo "<img class='profile-img' src='$path2root/user/images/$username.jpg' />"; ?>
        <a class="btn btn-large btn-primary pull-right" href="#" title="#">Ask a Question</a>
        <p><span class="label label-info">Member since: <?php echo $row['created']; ?></span></p>
        <p>You are user <span class="badge badge-inverse">#<?php echo $row['user_id']; ?></span>
        <br />
        <h1><?php echo "Hey there, " . $row['first_name'] . " " . $row['last_name'] . "!";?></h1>
        <br />
        <h2>Welcome to your Biindle</h2>
        <br />
        <h4>My Website</a>
          <br />
        <a href="<?php echo $row['website']; ?>" title="<?php echo $row['first_name']; ?>'s Website">
          <?php echo $row['website']; ?>
        </a>
        <br />
        <h4>My Email</a>
          <br />
        <a href="mailto:<?php echo $row['email']; ?>" title="<?php echo $row['first_name']; ?>'s Email">
          <?php echo $row['email']; ?>
        </a>
        <br />
        <h4>About Me</h4>
        <p><?php echo $row['about']; ?></p>
        <br />
        <br />
        <?php } // End of while loop ?>
      </div>
    </div><!-- .well -->
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