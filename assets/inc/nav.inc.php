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
      <img src="/img/logo.png" alt="" width="100" />
    </a>
    <div class="container">
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <!--
          <li <?php if ($currentPage == 'index.php') {
            echo 'class="active"';} ?>><a class="first" href="<?php echo $path2root ?>/index.php">Home</a></li>-->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Account
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo "$path2root"; ?>/log_in.php" title="#">Log-in</a></li>
              <li><a href="<?php echo "$path2root"; ?>/user/" title="#">My Biindle</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- .nav-collapse -->
    </div><!-- .container -->
  </div><!-- .navbar-inner -->
</div><!-- .navbar -->