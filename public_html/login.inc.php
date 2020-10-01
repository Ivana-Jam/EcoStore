<?php
if (isset($_POST['login-submit'])) {
  //Get info from DB
  require 'dbh.inc.php';

  //Retrieve information from user's input
  //mysqli_real_escape_string() function ensures that the DB reads input as code and not text (sql injection protection)
  $mailuid = mysqli_real_escape_string($conn, $_POST['mailuid']);
  $password = mysqli_real_escape_string($conn, $_POST['pwd']);

  //If empty
  if (empty($mailuid) || empty($password)) {
    header("Location: index2.php?error=emptyfields&mailuid=".$mailuid);
    exit();
  }
  else {
    //Select all entries from users with the inputted username and email
    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
    //Initialize a new statement
    $stmt = mysqli_stmt_init($conn);
    //run sql statement and check if it works inside the DB
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: index2.php?error=sqlerror");
      exit();
    }
    //grab information from select statement
    else {
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      //Check if a result was actually returned from the DB
      if ($row = mysqli_fetch_assoc($result)) {
        //If username exists, retrieve password and hash it and check if the two passwords match up
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        if ($pwdCheck == false) {
          header("Location: index2.php?error=wrongpwd");
          exit();
        }
        //if password matches username
        else if ($pwdCheck == true) {
          session_start();
          //session variables to see if the user if logged in or not
          $_SESSION['id'] = $row['idUsers'];
          $_SESSION['uid'] = $row['uidUsers'];
          $_SESSION['email'] = $row['emailUsers'];
          header("Location: index2.php?login=success");
          exit();
        }
      }
      else {
        header("Location: index2.php?login=wronguidpwd");
        exit();
      }
    }
  }
  //close the prepeared statements
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  //If user accesses this page through url then send them back
  header("Location: signup.php");
  exit();
}
