<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>

<div class="navbar">
  <div class="navbar-inner">
    <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <a class="brand" href="/">
      <img src="/img/logo.png" alt="" width="53" />
    </a>
    <div class="container">
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li <?php if ($currentPage == 'about.php') {
            echo 'class="active"';} ?>><a href="<?php echo $path2root ?>/about.php">About</a></li>
          
          <?php if(isset($_SESSION['authenticated'])) { ?>
          
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if (file_exists("$path2root/user/images/$username.jpg"))
              echo "<img class='profile-img' src='$path2root/user/images/$username.jpg' width=\"20\" height=\"20\" />&nbsp;&nbsp;$username"; ?>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href='<?php echo "$path2root"; ?>/user/index.php?username=<?php echo $row['username']; ?>' title="#">My Biindle</a></li>
              <li><a href="<?php echo "$path2root"; ?>/user/settings.php" title="#">Settings</a></li>
              <li><a href="<?php echo "$path2root"; ?>/user/messages.php" title="#">Messages</a></li>
              <li>
                <form id="logoutForm" method="post" action="<?php logOut() ?>">
                  <button name="logout" id="logout">Log Out</button>
                </form>
              </li>
            </ul>
          </li>
          
          <?php } else { ?>
          
          <li <?php if ($currentPage == 'log_in.php') {
            echo 'class="active"';} ?>><a href="<?php echo $path2root ?>/log_in.php">Log In</a></li>
          
          <?php } ?>
        </ul>
      </div><!-- .nav-collapse -->
    </div><!-- .container -->
  </div><!-- .navbar-inner -->
</div><!-- .navbar -->