<div class="well user-sidebar">
	<?php 
	if (file_exists("$path2root/user/images/$username.jpg")) {
		echo "<img class='profile-img img-polaroid' src='$path2root/user/images/$username.jpg' />"; 
	} else {
		echo "<img class='profile-img img-polaroid' src='http://placekitten.com/150/150' />"; 
	}
	?>
	<ul id="user_menu" class="nav nav-list">
	  <li><a href="/user/index.php?username=<?php echo $username; ?>"><i class="icon-home"></i> Profile</a></li>
	  <li><a href="/user/settings.php?username=<?php echo $username; ?>"><i class="icon-cog"></i> Account Settings</a></li>
	  <li><a href="/user/inbox/index.php?username=<?php echo $username; ?>"><i class="icon-inbox"></i> Inbox</a></li>
	  <li><a href="#" title="#"><i class="icon-fire"></i> Activity Feed</a></li>
	  <li><a href="#" title="#"><i class="icon-heart"></i> Charities</a></li>
	  <li><a href="#" title="#"><i class="icon-calendar"></i> Events</a></li>
	  <li><a href="#" title="#"><i class="icon-bullhorn"></i> Network</a></li>
	  <li><a href="#" title="#"><i class="icon-tags"></i> Groups</a></li>
	  <li><a href="#" title="#"><i class="icon-globe"></i> Map</a></li>
	  <!--<li><a href="/user/members.php?username=<?php echo $username; ?>"><i class="icon-user"></i> Members</a></li>-->
	</ul>
</div>