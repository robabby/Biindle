<?php 
if (file_exists("$path2root/user/images/$user.jpg"))
echo "<img class='profile-img' src='$path2root/user/images/$user.jpg' />"; 
?>

<hr />

<ul id="user_menu" class="nav nav-list">
  <li><a href="/user/index.php?username=<?php echo $user; ?>"><i class="icon-home"></i> Profile</a></li>
  <li><a href="/user/settings.php?username=<?php echo $user; ?>"><i class="icon-cog"></i> Account Settings</a></li>
  <li><a href="/user/inbox/index.php?username=<?php echo $user; ?>"><i class="icon-inbox"></i> Inbox</a></li>
  <li><a href="/user/members.php?username=<?php echo $user; ?>"><i class="icon-user"></i> Members</a></li>
</ul>