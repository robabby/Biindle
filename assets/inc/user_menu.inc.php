<?php 
if (file_exists("$path2root/user/images/$user.jpg"))
echo "<img class='profile-img' src='$path2root/user/images/$user.jpg' /><br /><br />"; 
?>
<p><span class="label label-info">Member since: <?php echo $created; ?></span></p>

<br />

<p><span class="badge badge-info"><?php echo $user_id; ?></span></p>
<hr />

<ul id="user_menu" class="nav nav-list">
  <li><a class="btn" href="/user/index.php?username=<?php echo $user; ?>"><i class="icon-home"></i> Profile</a></li>
  <li><a class="btn" href="/user/settings.php?username=<?php echo $user; ?>"><i class="icon-edit"></i> Account Settings</a></li>
  <li><a class="btn" href="/user/messages.php?username=<?php echo $user; ?>"><i class="icon-envelope"></i> Messages</a></li>
  <li><a class="btn" href="/user/members.php?username=<?php echo $user; ?>"><i class="icon-user"></i> Members</a></li>
</ul>