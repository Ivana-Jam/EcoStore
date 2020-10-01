<?php
  session_start();
  require 'dbh.inc.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <!--CSS Stylesheet-->
    <link rel="stylesheet" href="adminPanel.css">
    <title>Admin</title>
  </head>
  <header>
    <div>
      <h1>Eco Mall</h1>
      <nav class="nav-header-main">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="loginHeader.php">Login</a></li>
          <li><a href="signup.php">Signup</a></li>
          <li><a href="shop.php">Products</a></li>
          <li><a href="contact.php">Contact Us</a></li>
          <li><a href="reviews-all.php">Reviews</a></li>
          <li><a href="reviews-myreviews.php">My Reviews</a></li>
        </ul>
    </div>
  </header>
  <body>
    <div class="admin">
      <?php
      //If the "Admin Panel" button is clicked then load info from database
      if (isset($_POST['admin'])) {
        echo'<h2>Admin Panel</h2>';
        //Link to logout.inc.php when clicking on logout
        echo '<form action="logout.inc.php" method="post">
          <button class="banner-btn" type="submit" name="login-submit">Logout</button>
        </form>
        <br>';
        //Query to select all usernames and emails from users db
        $sql = "SELECT uidUsers, emailUsers FROM users";
        $result = $conn->query($sql);

        echo'<h4>User Information</h4>';
        //If more than 1 result is retrieved then display the information in tables
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo '<table class="data-table">
                    <tr>
                      <th>Username</th>
                      <th>Email</th>
                    </tr>
                    <tr>
                      <td>'.$row["uidUsers"].'</td>
                      <td>'.$row["emailUsers"].'</td>
                    </tr>
                  </table>';      }
  }
    //The case that no results are retrieved
    else {
        echo "0 results";
    }
    $conn->close();
      }


      else{
        //If user accesses this page through url then send them back
        header("Location: signup.php");
        exit();
      }
      ?>
    </div>

  </body>

</html>
