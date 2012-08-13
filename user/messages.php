<?php   
  $path2root = "..";
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

  $conn = dbConnect('read');
  $sql = "SELECT * FROM messages WHERE recip = '".$user."'";
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
        <div class="tabbable"> <!-- Only required for left/right tabs -->
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Inbox</a></li>
            <li><a href="#tab2" data-toggle="tab">Compose</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab1">
              <table class="table table-striped table-bordered">
              <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td>
                    <p><?php echo $row['id']; ?></p>
                  </td>
                  <td>
                    <p><?php echo $row['auth']; ?></p>
                  </td>
                  <td>
                    <p><?php echo $row['Subject']; ?></p>
                  </td>
                  <td>
                    <p><?php echo $row['time']; ?></p>
                  </td>
                </tr>
              <?php } // END OF WHILE LOOP ?>
              </table>
            </div>
            <div class="tab-pane" id="tab2">
              <?php
              if (isset($success)) {
                echo "<p>$success</p>";
              } elseif (isset($errors) && !empty($errors)) {
                echo '<ul>';
                foreach ($errors as $error) {
                echo "<li>$error</li>";
                }
                echo '</ul>';
              }
              ?>
              <form id="form1" method="post" action="">
                <p>
                  <label for="recip">To:</label>
                  <input name="recip" type="text" id="recip">
                </p>
                <p>
                  <input name="auth" type="hidden" id="auth" value="<?php echo $user; ?>">
                </p>
                <p>
                  <label for="subject">Subject:</label>
                  <input name="subject" type="text" id="subject">
                </p>
                <p>
                  <label for="message">Message:</label>
                  <textarea class="span12" rows="10" name="message" id="message"></textarea>
                </p>
                <p>
                  <button class="btn btn-primary" type="submit" name="send" id="send">&nbsp;&nbsp;Send Message&nbsp;&nbsp;</button>
                </p>
              </form>
            </div><!-- tab-pane -->
          </div><!-- .tab-content -->
        </div>
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