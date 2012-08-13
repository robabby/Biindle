<?php
// Page Variables
$user = $_SESSION['username'];
$user_id = queryUserId($user);
$created = queryUserCreated($user);

// create database connection

$conn = dbConnect('read');
$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
$result = $conn->query($sql) or die(mysqli_error($conn));
$row = $result->fetch_assoc(); 

function queryUserId($user) {   
    require_once("connection.inc.php");     
    $conn = dbConnect('read');
    $sql = "SELECT * FROM users WHERE username = '".$user."'";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    $row = $result->fetch_assoc();
    return $row['user_id'];
}

function queryUserName($user) {
    require_once("connection.inc.php"); 
    $conn = dbConnect('read');
    $sql = "SELECT * FROM users WHERE username = '".$user."'";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    $row = $result->fetch_assoc();
    return $row['username'];
}

function queryUserCreated($user) {  
    require_once("connection.inc.php");       
    $conn = dbConnect('read');
    $sql = "SELECT * FROM users WHERE username = '".$user."'";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    $row = $result->fetch_assoc();
    return $row['created'];
}

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