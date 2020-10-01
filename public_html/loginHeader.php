<?php
  session_start();
  require "dbh.inc.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Shop</title>
    <!--CSS Stylesheet-->
    <link rel="stylesheet" type="text/css" href="loginSignup.css" />

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
      <div class="header-login">
      <?php
        //if we don't have the session variables set in the website then the user is logged in
        if (!isset($_SESSION['id'])) {
          echo '<form action="login.inc.php" method="post">';

          if (!empty($_GET["mailuid"])) {
            echo '<input type="text" name="mailuid" placeholder="E-mail/Username" value="'.$_GET["mailuid"].'">';
          }
          else {
            echo '
            <table align="center">
            <tr align = "center">
            <td>
            <input type="text" name="mailuid" placeholder="E-mail/Username">
            </td>
            </tr>';
          }

          echo'
            <tr align = "center">
            <td>
            <input type="password" name="pwd" placeholder="Password">
            </td>
            </tr>
            <tr align = "center">
            <td>
            <button type="submit" class ="banner-btn" name="login-submit">Login</button>
            </td>
            </tr>
          </form>
          <tr align = "center">
          <td>
          <a href="signup.php"><button class="banner-btn">Signup</button></a>
          </td>
          </tr>
          </table>';
        }
        //if we have the session variables set in the website then the user is logged in
        else if (isset($_SESSION['id'])) {
          echo '
          <table align = "center">
          <tr align ="center">
          <td>
          <form action="logout.inc.php" method="post">
          </td>
          </tr>
          <tr align ="center">
          <td>
          <button type="submit" class ="banner-btn" name="login-submit">Logout</button>
          </td>
          </tr>
          </form>';

          //ONLY IF the username is adminUser can the user access the button to access the adminPanel.php
          if($_SESSION['uid'] == "adminUser"){
            echo '
            <table align = "center">
            <tr align ="center">
            <td>
            <form action="adminPanel.php" method="post">
            </td>
            </tr>
            <tr align ="center">
            <td>
            <button class="banner-btn" type="submit" name="admin">Access AdminPanel</button>
            </td>
            </tr>
            </form>';
          }
          //Only authenticated users can shop
          else{
            echo'
            <tr align ="center">
            <td>
            <a href="shop.php"><button class = "banner-btn">Shop</button></a>
            </td>
            </tr>
            </table>';
              }
        }
        ?>
      </div>
      </div>
    </header>
