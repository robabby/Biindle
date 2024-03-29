<?php 
  $path2root = "../..";
  require_once("$path2root/assets/inc/session_timeout.inc.php");
  
  if (isset($_GET['username'])) {
  
    require_once("$path2root/assets/inc/profile_funcs.inc.php");

    try {
    
    include("$path2root/assets/inc/title.inc.php"); 
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
        <?php
        if (file_exists("$path2root/user/images/$username.jpg"))
        echo "<img class='profile-img' src='$path2root/user/images/$username.jpg' /><br /><br />"; 
        ?>
        <p><span class="label label-info">Member since: <?php echo $row['created']; ?></span></p>

        <br />

        <p><span class="badge badge-info"><?php echo $row['user_id']; ?></span></p>
        <hr />
        <?php include("$path2root/assets/inc/profile_menu.inc.php"); ?>
      </div>
    </div>
    <div class="span9">
      <div class="well">
        <a class="btn btn-large btn-primary pull-right" href="#" title="#">Ask a Question</a>
        <br />
        
        <h1><?php echo $row['first_name'] . " " . $row['last_name'];?></h1>
        <br />
        
        <h4>My Website</a>
          <br />
        <a href="<?php echo $row['website']; ?>" title="<?php echo $row['first_name']; ?>'s Website">
          <?php echo $row['website']; ?>
        </a>
        <br />
        <br />
        
        <h4>My Email</a>
          <br />
        <a href="mailto:<?php echo $row['email']; ?>" title="<?php echo $row['first_name']; ?>'s Email">
          <?php echo $row['email']; ?>
        </a>
        <br />
        <br />
        
        <h4>About Me</h4>
        
        <p><?php echo $row['about']; ?></p>
        <br />
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

} else {
  header('Location: /');
}

?>