<?php   
  $path2root = "..";
  
  require_once("$path2root/assets/inc/session_timeout.inc.php");
  require_once("$path2root/assets/inc/user_funcs.inc.php");
  require_once("$path2root/assets/inc/utility_funcs.inc.php");

  if (!isset($_SESSION['authenticated']))
    die("<br /><br />You need to login to view this page");

  if (isset($_SESSION['username']) && queryUserName($_GET['username'])) {

  $loggedin = true;
  $username = $_SESSION['username'];
  $user_id = queryUserId($username);

  $conn = dbConnect('read');
  $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
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
      <div class="hero-unit">
        <?php 
          
        $conn = dbConnect('write');
        $sql = "SELECT * FROM messages WHERE recip = '".$username."'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        $num = $result->fetch_assoc(); 

        if (isset($_GET['view'])) {
          $view = sanitizeString($_GET['view']);
        } else { 
          $view = $username;
        }

        if (isset($_POST['text']))
        {
          $text = sanitizeString($_POST['text']);

          if ($text != "")
          {
            $pm = substr(sanitizeString($_POST['pm']),0,1);
            $time = time();
            queryMysql("INSERT INTO messages VALUES(NULL,
                   '$user', '$view', '$pm', $time, '$text')");
          }
        }

        if ($view != "")
        {
          if ($view)
          {
            $name1 = "Your";
            $name2 = "Your";
          }
          else
          {
            $name1 = "<a href='members.php?username=$username&view=$view'>$view</a>'s";
            $name2 = "$view's";
          }

          echo "<h3>$name1 Messages</h3>";
  
echo <<<_END
<form method='post' action='messages.php?username=$username&view=$view'>
  <label>Type here to leave a message:<label><br />
  <textarea name='text' cols='40' rows='5'></textarea><br />
  <label>Public
  <input type='radio' name='pm' value='0' checked='checked' /></label>
  <label>Private
  <input type='radio' name='pm' value='1' /></label>
  <input class='btn' type='submit' value='Post Message' />
  <br />
  <br />
</form>
_END;

          if (isset($_GET['erase']))
          {
            $erase = sanitizeString($_GET['erase']);
            queryMysql("DELETE FROM messages WHERE id=$erase
                    AND recip='$user'");
          }
  
          for ($j = 0 ; $j < $num ; ++$j)
          {
            $row = mysql_fetch_row($result);

            if ($row[3] == 0 ||
                $row[1] == $user ||
                $row[2] == $user)
            {
              echo date('M jS \'y g:sa:', $row[4]);
              echo " <a href='rnmessages.php?";
              echo "view=$row[1]'>$row[1]</a> ";

              if ($row[3] == 0)
              {
                echo "wrote: &quot;$row[5]&quot; ";
              }
              else
              {
                echo "whispered: <i><font
                color='#006600'>&quot;$row[5]&quot;</font></i> ";
              }

              if ($row[2] == $user)
              {
                echo "[<a href='rnmessages.php?view=$view";
                echo "&erase=$row[0]'>erase</a>]";
              }
              echo "<br>";
            }
          }
        }

        $num = $result->fetch_assoc(); 

        if (!$num) echo "<li>No messages yet</li><br />";
        echo "<div class='btn-group'>";
        echo "<a class='btn' href='messages.php?username=$username&view=$view'>Refresh</a><a class='btn' href='rnfriends.php?view=$view'>View Friends</a>";
        echo "</div>";
        ?>
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