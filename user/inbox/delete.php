<?php   
  $path2root = "../..";
  require_once("$path2root/assets/inc/session_timeout.inc.php");
  require_once("$path2root/assets/inc/user_funcs.inc.php");
  require_once("$path2root/assets/inc/utility_funcs.inc.php");

  if (isset($_SESSION['username']) && isset($_SESSION['authenticated'])) {

  $loggedin = true;
  $user = $_SESSION['username'];
  $user_id = queryUserId($user);

  // Send a message
  if (isset($_POST['send'])) {
    $recip = trim($_POST['recip']);
    $auth = trim($_POST['auth']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    require_once("$path2root/assets/inc/send_message.inc.php");
  }

  // initialize flags
  $OK = false;
  $done = false;
  // create database connection
  $conn = dbConnect('write');
  // initialize statement
  $stmt = $conn->stmt_init();

  // get details of selected record
  if (isset($_GET['id']) && !$_POST) {
    // prepare SQL query
    $sql = 'SELECT id, auth, recip, subject, time, message
        FROM messages WHERE id = ?';
    $stmt->prepare($sql);
    // bind the query parameter
    $stmt->bind_param('i', $_GET['id']);
    // bind the results to variables
    $stmt->bind_result($id, $auth, $recip, $subject, $time, $message);
    // execute the query, and fetch the result
    $OK = $stmt->execute();
    $stmt->fetch();
    // free the database resource for the next query
    $stmt->free_result();
  }
  
  try {
  
  include("$path2root/assets/inc/title.inc.php"); 

?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="messages">
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
        <h3><?php echo htmlentities($subject, ENT_COMPAT, 'utf-8'); ?></h3>
        <span class="label label-info"><?php echo htmlentities($auth, ENT_COMPAT, 'utf-8'); ?></span>
        <br />
        <br />
        <?php echo htmlentities($message, ENT_COMPAT, 'utf-8'); ?>
      </div><!-- .span -->
    </div><!-- .row -->
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