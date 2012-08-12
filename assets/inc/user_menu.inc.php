<ul class="nav nav-list">
  <li><a href="/user/index.php?username=<?php echo $row['username']; ?>"><i class="icon-home"></i> Profile</a></li>
  <li><a href="/user/settings.php?username=<?php echo $row['username']; ?>"><i class="icon-edit"></i> Account Settings</a></li>
  <li><a href="/user/messages.php?username=<?php echo $row['username']; ?>&view=1"><i class="icon-envelope"></i> Messages</a></li>
  <li><a href="/user/members.php?username=<?php echo $row['username']; ?>"><i class="icon-user"></i> Members</a></li>
</ul>