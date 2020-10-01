<?php
if (isset($_POST['signup-submit'])) {
  //gain access to connection to a database
  require 'dbh.inc.php';

  //Pass information from sign up form into new variables
  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  //Error handlers
  //check if any fields are empty
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    //header function links user back to page they were at with the fields still filled
    header("Location: signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit(); //stop script from running below this function
  }
  //Check if valid email AND valid username
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: signup.php?error=invaliduidmail");
    exit();
  }
  //Check if valid username
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: signup.php?error=invaliduid&mail=".$email);
    exit();
  }
  //Check if valid email
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: signup.php?error=invalidmail&uid=".$username);
    exit();
  }
  //Check if two passwords match
  else if ($password !== $passwordRepeat) {
    header("Location: signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  }
  //Condition for if a user tried to create a username that already exists in the database
  else {
    //sql statement to run in db
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?;";
    $stmt = mysqli_stmt_init($conn);
    //If error running sql statement in database
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: signup.php?error=sqlerror");
      exit();
    }
    //Pass info from user into DB
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      //Store result from DB into stmt
      mysqli_stmt_store_result($stmt);
      //Checking how many rows from the database do we get?
      $resultCheck = mysqli_stmt_num_rows($stmt);
      mysqli_stmt_close($stmt);
      //If multiple rows returned
      if ($resultCheck > 0) {
        header("Location: signup.php?error=usertaken&mail=".$email);
        exit();
      }
      //Run sql statement like above that inserts using prepared statments
      //Inserting the values into the database
      else {
        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        //If error running sql statement in database
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: signup.php?error=sqlerror");
          exit();
        }
        else {
          //hash the password to prevent hacking
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
          mysqli_stmt_execute($stmt);
          header("Location: signup.php?signup=success");
          exit();

        }
      }
    }
  }
  //close DB connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
//Send user back to signup page if they access this page without clicking the signup form
else {
  header("Location: signup.php");
  exit();
}
