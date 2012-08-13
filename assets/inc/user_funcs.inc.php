<?php
// Page Variables
$user_id = isset($_GET['user_id']);
$username = isset($_SESSION['username']);

// create database connection
require_once("$path2root/assets/inc/connection.inc.php");

$conn = dbConnect('read');
$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
$result = $conn->query($sql) or die(mysqli_error($conn));
$row = $result->fetch_assoc();

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

	  header('Location: /');
	  exit;
	}
}

function queryUserId($username) {        
    $conn = dbConnect('read');
    $sql = "SELECT * FROM users WHERE username = '".$username."'";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    $row = $result->fetch_assoc();
    return $row['user_id'];
}

function queryUserName($username) {
    $conn = dbConnect('read');
    $sql = "SELECT * FROM users WHERE username = '".$username."'";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    $row = $result->fetch_assoc();
    return $row['username'];
}

function queryUser($user_id) {        
    $conn = dbConnect('read');
    $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    $row = $result->fetch_assoc();
    return $row;
}