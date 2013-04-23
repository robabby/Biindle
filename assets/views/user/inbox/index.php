<?php   
  $path2root = "../../..";
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

  // Populate Inbox
  $sql = "SELECT * FROM messages WHERE recip = '".$user."' ORDER BY time DESC";
  $result = $conn->query($sql) or die(mysqli_error($conn));
  $row = $result->fetch_assoc(); 

  // Populate Outbox
  $sql2 = "SELECT * FROM messages WHERE auth = '".$user."' ORDER BY time DESC";
  $result2 = $conn->query($sql2) or die(mysqli_error($conn));
  $row2 = $result2->fetch_assoc(); 
  
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
      <?php include("$path2root/assets/inc/user_menu.inc.php"); ?>
    </div>
    <div class="span9">
      <div class="well">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
          <ul class="nav nav-tabs">
            <li><a href="#tab1" data-toggle="tab">Compose</a></li>
            <li class="active"><a href="#tab2" data-toggle="tab">Inbox</a></li>
            <li><a href="#tab3" data-toggle="tab">Sent</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab1">
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
            <div class="tab-pane active" id="tab2">
              <table class="table table-striped table-bordered">
              <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td>
                    <p><a href="/user/profile.php?username=<?php echo $row['auth']; ?>" title=""><?php echo $row['auth']; ?></a></p>
                  </td>
                  <td>
                    <p><a href="/user/inbox/message.php?id=<?php echo $row['id']; ?>" title=""><?php echo $row['Subject']; ?></a></p>
                  </td>
                  <td>
                    <p><?php echo date('M/d/Y', $row['time']); ?></p>
                  </td>
                </tr>
              <?php } // END OF WHILE LOOP ?>
              </table>
            </div>
            <div class="tab-pane" id="tab3">
              <table class="table table-striped table-bordered">
              <?php while($row2 = $result2->fetch_assoc()) { ?>
                <tr>
                  <td>
                    <p><a href="/user/profile.php?username=<?php echo $row2['auth']; ?>" title=""><?php echo $row2['auth']; ?></a></p>
                  </td>
                  <td>
                    <p><a href="/user/inbox/message.php?id=<?php echo $row2['id']; ?>" title=""><?php echo $row2['Subject']; ?></a></p>
                  </td>
                  <td>
                    <p><?php echo date('M/d/Y', $row2['time']); ?></p>
                  </td>
                </tr>
              <?php } // END OF WHILE LOOP ?>
              </table>
            </div>
          </div><!-- .tab-content -->
        </div><!-- .tabbable -->
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