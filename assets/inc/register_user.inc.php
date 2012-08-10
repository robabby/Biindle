<?php
require_once("$path2root/assets/classes/CheckPassword.php");
$usernameMinChars = 6;
$errors = array();
if (strlen($username) < $usernameMinChars) {
  $errors[] = "Username must be at least $usernameMinChars characters.";
}
if (preg_match('/\s/', $username)) {
  $errors[] = 'Username should not contain spaces.';
}
$checkPwd = new Ps2_CheckPassword($password, 10);
$checkPwd->requireMixedCase();
$checkPwd->requireNumbers(2);
$checkPwd->requireSymbols();
$passwordOK = $checkPwd->check();
if (!$passwordOK) {
  $errors = array_merge($errors, $checkPwd->getErrors());
}
if ($password != $retyped) {
  $errors[] = "Your passwords don't match.";
}
if (!$errors) {
  // include the connection file
  require_once('connection.inc.php');
  $conn = dbConnect('write');
  // create a salt using the current timestamp
  $salt = time();
  // encrypt the password and salt with SHA1
  $pwd = sha1($password . $salt);
  // prepare SQL statement
  $sql = 'INSERT INTO users (username, salt, pwd, first_name, last_name, email, created)
          VALUES (?, ?, ?, ?, ?, ?, NOW())';
  $stmt = $conn->stmt_init();
  $stmt = $conn->prepare($sql);
  // bind parameters and insert the details into the database
  $stmt->bind_param('sissss', $username, $salt, $pwd, $first_name, $last_name, $email);
  $stmt->execute();
  if ($stmt->affected_rows == 1) {
	$success = "<p>$username has been registered. You may now <a class=\"success\" href='/log_in.php'>log in</a></p>";
  } elseif ($stmt->errno == 1062) {
	$errors[] = "$username is already in use. Please choose another username.";
  } else {
	$errors[] = 'Sorry, there was a problem with the database.';
  }
}