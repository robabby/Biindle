<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    
    <a class="brand" href="/">
      <img src="<?php echo $path2root; ?>/assets/img/logo_inverted.png" alt="" width="53" />
    </a>
    
    <div class="container-fluid">     
      
      <!-- Drawer Toggle -->
      <a id="drawer-toggle" class="btn" href="#"><i class="icon-th-list"></i></a>
      
      <ul class="nav pull-right"> 
        
      <?php 
      if(isset($_SESSION['authenticated'])) {  
        $username = $_SESSION['username']; 
      ?>
        
        <li id="notifications" class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon-bell"></i>
            <span class="badge badge-important">1</span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#" title="#">You Have a notification</a></li>
          </ul>
        </li>
        
        <li id="user-dropdown" class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php 
            if (file_exists("$path2root/assets/views/user/images/$username.jpg")) {
              echo "<img class='profile-img' src='$path2root/assets/views/user/images/$username.jpg' width=\"20\" height=\"20\" />&nbsp;&nbsp;$username"; 
            } else {
              echo "<img class='profile-img' src='http://placekitten.com/150/150' width=\"20\" height=\"20\" />&nbsp;&nbsp;$username"; 
            }
            ?>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo "$path2root"; ?>/assets/views/user/index.php?username=<?php echo $username; ?>" title="#"><i class="icon-home"></i> Profile</a></li>
            <li><a href="#" title="#"><i class="icon-fire"></i> Activity Feed</a></li>
            <li><a href="#" title="#"><i class="icon-th"></i> Apps</a></li>
            <li><a href="<?php echo "$path2root"; ?>/assets/views/user/inbox/index.php?username=<?php echo $username; ?>" title="#"><i class="icon-inbox"></i> Inbox</a></li>
            <!--<li><a href="/user/members.php?username=<?php echo $username; ?>"><i class="icon-user"></i> Members</a></li>-->
            <li><a href="<?php echo "$path2root"; ?>/assets/views/user/settings.php?username=<?php echo $username; ?>" title="#"><i class="icon-cog"></i> Settings</a></li>
            <li>
              <form id="logoutForm" method="post" action="<?php logOut() ?>">
                <button name="logout" id="logout">&nbsp;<i class="icon-road"></i> Log Out</button>
              </form>
            </li>
          </ul>
        </li>
        
      <?php } else { ?>

        <li>
          <a class="login-trigger" href="#">Log In</a>
        </li>

      <?php } ?>

      </ul>

    </div><!-- .container-fluid -->
  </div><!-- .navbar-inner -->
</div><!-- .navbar -->