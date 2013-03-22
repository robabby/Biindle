<?php

if(isset($_REQUEST['requestUser']) && $_REQUEST['requestUser'] == 1) {
  $username = $_REQUEST['username'];
  echo userJson($username);
}

// Find user_id with $username
function queryUserId($username) {   
  require_once("connection.inc.php");     
  $conn = dbConnect('read');
  $sql = "SELECT * FROM users WHERE username = '".$username."'";
  $result = $conn->query($sql) or die(mysqli_error($conn));
  $row = $result->fetch_assoc();
  return $row['user_id'];
}

// Find username with log_in submission
function queryUserName($username) {
  require_once("connection.inc.php"); 
  $conn = dbConnect('read');
  $sql = "SELECT * FROM users WHERE username = '".$username."'";
  $result = $conn->query($sql) or die(mysqli_error($conn));
  $row = $result->fetch_assoc();
  return $row['username'];
}

// Check when a user was created
function queryUserCreated($username) {  
  require_once("connection.inc.php");       
  $conn = dbConnect('read');
  $sql = "SELECT * FROM users WHERE username = '".$username."'";
  $result = $conn->query($sql) or die(mysqli_error($conn));
  $row = $result->fetch_assoc();
  return $row['created'];
}

// Deliver a JSON output of user details
function userJson($username) {
  require_once("connection.inc.php");       
  $conn = dbConnect('read');
  $sql = "SELECT user_id, username, first_name, last_name, email FROM users WHERE username = '".$username."'";
  $result = $conn->query($sql) or die(mysqli_error($conn));
  $row = $result->fetch_assoc();

  $user = array(
    "user_info" => array($row)
  );

  return json_encode($user);
}

// Log out and kill the $_SESSION
function logOut() {
  if (isset($_POST['logout'])) {
    // empty the $_SESSION array
    $_SESSION = array();
    // invalidate the session cookie
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time()-86400, '/');
    }
    // end session and redirect
    session_destroy();
    // redirect and exit
    header('Location: /');
    exit;
  }
}