<?php 
  $path2root = "..";
  
  require_once("$path2root/assets/inc/session_timeout.inc.php");
  require_once("$path2root/assets/inc/user_funcs.inc.php");

  if (isset($_SESSION['username']) && queryUserName($_GET['username'])) {

  $loggedin = true;
  $username = $_SESSION['username'];
  $user_id = queryUserId($username);

  $conn = dbConnect('read');
  $sql = "SELECT * FROM users";
  $result = $conn->query($sql) or die(mysqli_error($conn));
  $row = $result->fetch_assoc(); 
  
  try {
  
  include("$path2root/assets/inc/title.inc.php"); 

?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="members">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
      <div class="well">
        <?php include("$path2root/assets/inc/user_menu.inc.php"); ?>
      </div>
    </div>
    <div class="span9">
      <?php while($row = $result->fetch_assoc()) { ?>
      <div class="well">
        <a href="/user/profile.php?username=<?php echo $row['username']; ?>" title="">
          <img class="profile-img" src="/user/images/<?php echo $row['username']; ?>.jpg" />
        </a>
        <h3><a href="/user/profile.php?username=<?php echo $row['username']; ?>"><?php echo $row['first_name'] . " " . $row['last_name']; ?></a></h3>
        <p><?php echo $row['username']; ?></p>
      </div>
      <?php } // END OF WHILE LOOP ?>
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

} else {
  header('Location: /');
}
?>