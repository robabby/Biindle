<?php 
  
  $path2root = "..";
  
  require_once("$path2root/assets/inc/session_timeout.inc.php");
  require_once("$path2root/assets/inc/user_functions.inc.php");

  if (isset($_GET['username']) && queryUserName($_GET['username'])) {

  $username = queryUserName($_GET['username']);
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
<body id="blank">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
      <div class="well">
        <?php include("$path2root/assets/inc/user_menu.inc.php"); ?>
      </div>
    </div>
    <div class="span9">
      <div class="well">
        <h2>Biindle Members</h2>
        <br />
        <?php while($row = $result->fetch_assoc()) { ?>
        <div class="well">
          <h3><a href="/user/index.php?username=<?php echo $row['username']; ?>"><?php echo $row['username']; ?></a></h3>
          <p><?php echo $row['first_name']; ?>&nbsp;<?php echo $row['last_name']; ?></p>
        </div>
        <?php } // END OF WHILE LOOP ?>
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

} else {
  header('Location: /');
}
?>