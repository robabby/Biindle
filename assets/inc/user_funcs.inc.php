<?php
// Page Variables
$username = $_SESSION['username'];
$user_id = queryUserId($username);
$created = queryUserCreated($username);

// create database connection
$conn = dbConnect('read');
$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
$result = $conn->query($sql) or die(mysqli_error($conn));
$row = $result->fetch_assoc(); 


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

function userArrayJson() {
  
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