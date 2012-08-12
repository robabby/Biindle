<?php 
  $path2root = "..";
  
  require_once("$path2root/assets/inc/session_timeout.inc.php");
  require_once("$path2root/assets/inc/user_functions.inc.php");

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

  //Update General Info
  if (isset($_POST['update'])) {
    $email = trim($_POST['email']);
    $website = trim($_POST['website']);
    $about = trim($_POST['about']);
    $user = trim($_POST['user']);
    require_once("$path2root/assets/inc/update_user.inc.php");
  }

  // Update Password
  if (isset($_POST['update_pass'])) {
    $password = trim($_POST['pwd']);
    $retyped = trim($_POST['conf_pwd']);
    require_once("$path2root/assets/inc/update_password.inc.php");
  }

  // Update Profile Image
  if (isset($_FILES['image']['name']))
  {
    $saveto = "$path2root/user/images/$username.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
    $typeok = TRUE;
    
    switch($_FILES['image']['type'])
    {
      case "image/gif":   $src = imagecreatefromgif($saveto); break;

      case "image/jpeg":  // Both regular and progressive jpegs
      case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;

      case "image/png":   $src = imagecreatefrompng($saveto); break;

      default:      $typeok = FALSE; break;
    }
    
    if ($typeok)
    {
      list($w, $h) = getimagesize($saveto);
      $max = 150;
      $tw  = $w;
      $th  = $h;
      
      if ($w > $h && $max < $w)
      {
        $th = $max / $w * $h;
        $tw = $max;
      }
      elseif ($h > $w && $max < $h)
      {
        $tw = $max / $h * $w;
        $th = $max;
      }
      elseif ($max < $w)
      {
        $tw = $th = $max;
      }
      
      $tmp = imagecreatetruecolor($tw, $th);
      imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
      imageconvolution($tmp, array( // Sharpen image
                    array(-1, -1, -1),
                    array(-1, 16, -1),
                    array(-1, -1, -1)
                     ), 8, 0);
      imagejpeg($tmp, $saveto);
      imagedestroy($tmp);
      imagedestroy($src);
    }
  }

?>
<!doctype html>
<html>
<head>
  <?php include("$path2root/assets/inc/head.inc.php"); ?>
</head>
<body id="user_settings">
<?php include("$path2root/assets/inc/nav.inc.php"); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
      <div class="well">
        <?php include("$path2root/assets/inc/user_menu.inc.php"); ?>
      </div>
    </div>
    <div class="span9">
        <div class="row-fluid">
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
          <form class="well form-horizontal" method='post' action='' enctype='multipart/form-data'>
            <h4>Update your profile image</h4>
            <br />
            <?php if (file_exists("$path2root/user/images/$username.jpg"))
              echo "<img src='$path2root/user/images/$username.jpg' />"; ?>
            <br />
            <br />
            <label for="image">Choose an Image:</label>
            <input type='file' name='image' size='14' maxlength='32' />
            <br />
            <br />
            <button class="btn btn-primary" type="submit" name="upload" id="upload">Update Image</button>
            </pre>
          </form>
          <form class="well form-horizontal" id="form2" method="post" action="">
            <h4>Change your email address</h4>
            <br />
            <p>
              <label for="email">Email:</label>
              <input name="email" type="text" id="email" value="<?php echo $row['email']; ?>">
            </p>
            <h4>Provide your blog or website address</h4>
            <br />
            <p>
              <label for="website">www.yoursite.com</label>
              <input name="website" type="text" id="website" value="<?php echo $row['website']; ?>">
            </p>
            <h4>Tell us a little about yourself</h4>
            <br />
            <p>
              <label for="about">About</label>
              <textarea name="about" id="about" rows="10"></textarea>
            </p>
            <p>
              <input type="hidden" name="user" id="user" value="<?php echo $username; ?>" />
              <button class="btn btn-primary" type="submit" name="update" id="update">Update Settings</button>
            </p>
          </form>
          <form class="well form-horizontal" id="form1" method="post" action="">
            <h4>Update your password</h4>
            <br />
            <p>
              <label for="pwd">Password:</label>
              <input name="pwd" type="password" id="pwd">
            </p>
            <p>
              <label for="conf_pwd">Retype-Password:</label>
              <input name="conf_pwd" type="password" id="conf_pwd">
            </p>
            <p>
              <button class="btn btn-success" type="submit" name="update_pass" id="update_pass">Update Password</button>
            </p>
          </form>
        </div><!-- .row -->
    </div><!-- span -->
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