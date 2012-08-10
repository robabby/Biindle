<?php
function dbConnect($usertype, $connectionType = 'mysqli') {
  $host = 'biindleadmin.db.7625389.hostedresource.com';
  $db = 'biindleadmin';
  if ($usertype  == 'read') {
	$user = 'biindleread';
	$pwd = 'Password#23';
  } elseif ($usertype == 'write') {
  	$user = 'biindleadmin';
	$pwd = 'Password#23';
  } else {
	exit('Unrecognized connection type');
  }
  if ($connectionType == 'mysqli') {
	$result = new mysqli($host, $user, $pwd, $db) ;
	if (!$result) die ('Cannot connect to database');
	return $result;
  } else {
    try {
      return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
    } catch (PDOException $e) {
      echo 'Cannot connect to database';
      exit;
    }
  }
}
/*
function dbConnect($usertype, $connectionType = 'mysqli') {
  $host = 'localhost';  
  $db = 'biindle';
  if ($usertype  == 'read') {
  $user = 'root';
  $pwd = '';
  } elseif ($usertype == 'write') {
    $user = 'root';
  $pwd = '';
  } else {
  exit('Unrecognized connection type');
  }
  if ($connectionType == 'mysqli') {
  $result = new mysqli($host, $user, $pwd, $db) ;
  if (!$result) die ('Cannot connect to database');
  return $result;
  } else {
    try {
      return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
    } catch (PDOException $e) {
      echo 'Cannot connect to database';
      exit;
    }
  }
}
*/
