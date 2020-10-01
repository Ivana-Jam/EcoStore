<?php
  session_start();
  require "dbh.inc.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="This is an example of a meta description. This will often show up in search results.">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="loginSignup.css">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/dfd3ed979b.js" crossorigin="anonymous"></script>
  </head>
  <body>

 <div class="container">
        <h1>Eco Mall</h1>
        <div class="nav">
          <nav>
            <table align = "center">
              <tr>
                <td><a href="index.html">Home</a></td>
                <td><a href="loginHeader.php">Login</a></td>
                <td><a href="signup.php">Sign Up</a></td>
                <td><a href="index.html">About</a></td>
                <td><a href="shop.php">Products</a></td>
                <td><a href="contact.php">Contact Us</a></td>
                <td><a href="reviews-all.php">Reviews</a></td>
                <td><a href="reviews-myreviews.php">My Reviews</a></td>
              </td>
              </tr>
            </table>
          </nav>
        </div>
      </div>
    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <?php
          //Error messages viewable by the user
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyfields") {
              echo '<p class="signuperror">Fill in all fields!</p>';
            }
            else if ($_GET["error"] == "invaliduidmail") {
              echo '<p class="signuperror">Invalid username and e-mail!</p>';
            }
            else if ($_GET["error"] == "invaliduid") {
              echo '<p class="signuperror">Invalid username!</p>';
            }
            else if ($_GET["error"] == "invalidmail") {
              echo '<p class="signuperror">Invalid e-mail!</p>';
            }
            else if ($_GET["error"] == "passwordcheck") {
              echo '<p class="signuperror">Your passwords do not match!</p>';
            }
            else if ($_GET["error"] == "usertaken") {
              echo '<p class="signuperror">Username is already taken!</p>';
            }
          }
          //Message to let the user know the signup was successful
          else if (isset($_GET["signup"])) {
            if ($_GET["signup"] == "success") {
              echo '<p class="signupsuccess">Signup successful!</p>';
            }
          }
          ?>
          <form class="form-signup" action="signup.inc.php" method="post">
            <?php

            //If username is empty
            if (!empty($_GET["uid"])) {
              echo '<input type="text" name="uid" placeholder="Username" value="'.$_GET["uid"].'">';
            }
            else {
              echo '<input type="text" name="uid" placeholder="Username">';
            }

            //if email is emty
            if (!empty($_GET["mail"])) {
              echo '<input type="text" name="mail" placeholder="E-mail" value="'.$_GET["mail"].'">';
            }
            else {
              echo '<input type="text" name="mail" placeholder="E-mail">';
            }
            ?>
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-repeat" placeholder="Repeat password">
            <button type="submit" name="signup-submit" class = "banner-btn">Signup</button>
          </form>
        </section>
      </div>
    </main>

<?php
  require "footer.php";
?>
