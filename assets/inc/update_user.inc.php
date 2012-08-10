<?php
$errors = array();
if (!$errors) {
  // include the connection file
  require_once('connection.inc.php');
  $conn = dbConnect('write');
  // prepare SQL statement
  $sql = 'UPDATE users SET email= ?, website= ?, about= ? WHERE username= ?';
  $stmt = $conn->stmt_init();
  $stmt = $conn->prepare($sql);
  // bind parameters and insert the details into the database
  $stmt->bind_param('ssss', $_POST['email'], $_POST['website'], $_POST['about'], $_POST['user']);
  $stmt->execute();
  if ($stmt->affected_rows == 1) {
	$success = "<div class=\"alert alert-success\">Congratulations! You have successfully updated your profile.</div>";
  }  else {
	$errors[] = 'Sorry, there was a problem with the database.';
  }
}