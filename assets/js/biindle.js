var Biindle = {};

Biindle.user = {
	username : "<?php echo $_SESSION['username']; ?>",
	first_name : "<?php echo $_SESSION['first_name']; ?>",
	last_name : "<?php echo $_SESSION['last_name']; ?>",
	email : "<?php echo $_SESSION['email']; ?>"
}