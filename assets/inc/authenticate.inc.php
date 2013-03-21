<?php
$username = trim($_POST['username']);
$password = trim($_POST['pwd']);

// location to redirect on success
$redirect = "/user/index.php?username=$username";

require_once('connection.inc.php');
$conn = dbConnect('read');
// get the username's details from the database
$sql = 'SELECT salt, pwd FROM users WHERE username = ?';
// initialize and prepare statement
$stmt = $conn->stmt_init();
$stmt->prepare($sql);
// bind the input parameter
$stmt->bind_param('s', $username);
// bind the result, using a new variable for the password
$stmt->bind_result($salt, $storedPwd);
$stmt->execute();
$stmt->fetch();
// encrypt the submitted password with the salt and compare with stored password
if (sha1($password . $salt) == $storedPwd) {
  // Check for authentication
  $_SESSION['authenticated'] = 'Jethro Tull';

  // Query the rest of the users information
  $conn = dbConnect('read');
  $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
  $result = $conn->query($sql) or die(mysqli_error($conn));
  $row = $result->fetch_assoc(); 

  if(!$row) {
  	echo "There was an error authenticating the user";
  } else {
  	// get the time the session started
    $_SESSION['start'] = time();
    session_regenerate_id();

    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['last_name'] = $row['last_name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

    header("Location: $redirect");
    exit;
  }
} else {
  // if no match, prepare error message
  $error = 'Invalid username or password';
}