<?php
require_once("nuke_magic_quotes.php");
$errors = array();
if (!$errors) {
  // include the connection file
  require_once('connection.inc.php');
  $conn = dbConnect('write');
  // create a salt using the current timestamp
  $time = time();
  // prepare SQL statement
  $sql = 'INSERT INTO messages (auth, recip, subject, time, message)
          VALUES (?, ?, ?, ?, ?)';
  $stmt = $conn->stmt_init();
  $stmt = $conn->prepare($sql);
  // bind parameters and insert the details into the database
  $stmt->bind_param('sssss', $auth, $recip, $subject, $time, $message);
  $stmt->execute();
  if ($stmt->affected_rows == 1) {
	$success = "<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a><h4 class=\"alert-heading\">Success!</h4>Your message has been sent to <a class=\"success\" href=\"/user/profile.php?username=$recip\">$recip</a>!</div>";
  } else {
	$errors[] = "<div class=\"alert alert-error\"><a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a><h4 class=\"alert-heading\">Oops!</h4>Something has gone wrong!  Better try again.  If the problem persists, <a href=\"#\">contact us</a>!</div>";
  }

}