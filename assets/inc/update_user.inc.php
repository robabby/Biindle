<?php
$errors = array();
if (!$errors) {
  // include the connection file
  require_once('connection.inc.php');
  $conn = dbConnect('write');
  // prepare SQL statement
  $sql = 'UPDATE users SET email= ?, website= ?, about= ?, twitter= ?, WHERE username= ?';
  $stmt = $conn->stmt_init();
  $stmt = $conn->prepare($sql);

  // Debug our statement
  if(!$stmt) {
    echo "Houston, we have a problem...";
    var_dump($stmt);
    mysqli_error($stmt);
  } else {
    // bind parameters and insert the details into the database
    $stmt->bind_param('sssss', $_REQUEST['email'], $_REQUEST['website'], $_REQUEST['about'], $_REQUEST['twitter'], $_REQUEST['user']);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
      $success = "<div class=\"alert alert-success\">Congratulations! You have successfully updated your profile.</div>";
    }  else {
      $errors[] = "<div class=\"alert alert-error\"><a class=\"close\" data-dismiss=\"alert\" href=\"#\">&times;</a>Sorry, there was a problem with the database.<br>".mysqli_error($conn)."</div>";
    }
  }
}