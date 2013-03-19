<?php
require_once("$path2root/assets/classes/CheckPassword.php");
$errors = array();
$checkPwd = new Ps2_CheckPassword($password, 6);
//$checkPwd->requireMixedCase();
//$checkPwd->requireNumbers();
//$checkPwd->requireSymbols();
$passwordOK = $checkPwd->check();
if (!$passwordOK) {
  $errors = array_merge($errors, $checkPwd->getErrors());
}
if ($password != $retyped) {
  $errors[] = "<div class=\"alert alert-error\"><a class=\"close\" data-dismiss=\"alert\" href=\"#\">&times;</a>Your passwords don't match.</div>";
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
  $sql = 'INSERT INTO users (salt, pwd)
          VALUES (?, ?)';
  $stmt = $conn->stmt_init();
  $stmt = $conn->prepare($sql);
  // bind parameters and insert the details into the database
  $stmt->bind_param('is', $salt, $pwd);
  $stmt->execute();
  if ($stmt->affected_rows == 1) {
	  $success = "<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\" href=\"#\">&times;</a>Congratulations! You have successfully updated your password.</div>";
  } else {
	  $errors[] = "<div class=\"alert alert-error\"><a class=\"close\" data-dismiss=\"alert\" href=\"#\">&times;</a>Sorry, there was a problem with the database. <br> ".mysql_error()." </div>";
  }
}