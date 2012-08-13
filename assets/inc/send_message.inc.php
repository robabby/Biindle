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
  $sql = 'INSERT INTO messages (auth, recip, subject, pm, time, message)
          VALUES (?, ?, ?, ?, ?, ?)';
  $stmt = $conn->stmt_init();
  $stmt = $conn->prepare($sql);
  // bind parameters and insert the details into the database
  $stmt->bind_param('ssssss', $auth, $recip, $subject, $pm, $time, $message);
  $stmt->execute();
  if ($stmt->affected_rows == 1) {
	$success = "<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a><h4 class=\"alert-heading\">Success!</h4>Your message has been sent to <a class=\"success\" href=\"/user/profile.php?username=$recip\">$recip</a>!</div>";
  } else {
	$errors[] = "<div class=\"alert alert-error\"><a class=\"close\" data-dismiss=\"alert\" href=\"#\">×</a><h4 class=\"alert-heading\">Oops!</h4>Something has gone wrong!  Better try again.  If the problem persists, <a href=\"#\">contact us</a>!</div>";
  }

/*
  $redirectTo = "/user/insex.php?username=$username";
  $to = "$email";
  $from = "Biindle";
  $subject = "Welcome to Biindle!";
  $headers = "From: $from\r\n";
  $message = "Thank you for signing up for Biindle.com!  You have traken your first step towards a better travelling future.\n\n Your Username: $username \n\n Your Password: $password \n\n  You can view your personal Biindle here: <a href=\"http://biindle.com/user/index.php?username=$username\">Biindle.com/$username</a>";
  $formFields = array_keys($_POST);
  for ($i = 0; $i < sizeof($formFields); $i++)
  {
      $theField = strip_tags($formFields[$i]);
      $theValue = strip_tags($_POST[$theField]);
      $message .= $theField;
      $message .= " = ";
      $message .= $theValue;
      $message .= "\n";
  }
  $success = mail($to, $subject, $message, $headers);
  if ($success)
  {
      header("Location: " . $redirectTo);
  }
  else
  {
      echo "An error occurred when sending the email.";
  }
*/

}