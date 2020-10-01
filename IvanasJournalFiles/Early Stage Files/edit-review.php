<?php
    session_start();
    require 'dbh.inc.php';

    if(isset($_GET['Edit']))
    {
      $rid = $_GET['Edit'];
    $res=mysqli_query($conn, "SELECT * FROM ratings WHERE ratingID='$rid'");
      $row = mysqli_fetch_array($res);

    }


      if(isset($_POST['newComment']))
      {
          $newComment = filter_var($_POST['newComment'], FILTER_SANITIZE_STRING);
          $rid = $_POST['reviewID'];
          $sql = "UPDATE ratings SET comment = '$newComment' WHERE ratingID='$rid'";

          if($result= mysqli_query($conn, $sql))
            {
              echo "Review posted successfully! <br>";
              echo "$row[0]";

            }
            else {
              echo "Unable to post review! <br>";
            }
      }


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Edit Review</title>
    <!--CSS Stylesheet-->
    <link rel="stylesheet" type="text/css" href="reviews.css" />

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/dfd3ed979b.js" crossorigin="anonymous"></script>

    <body>
      <div class="container">
        <h1>Eco Mall</h1>
        <div class="nav">
          <nav>
            <table align = "center">
              <tr>
                <td><a href="loginpage.php">Login/SignUp</a></td>
                <td><a href="index.html">About</a></td>
                <td><a href="shop.html">SHOP!</a></td>
                <td><a href="contact.html">Contact Us</a></td>
                <td><a href="cart.html">Shopping Bag</a></td>
              </tr>
            </table>
          </nav>
        </div>

        <form action = "edit-review.php" method="post">
          <center>

        <h1>Edit Review</h1>

        <div>
          <label for="comment">Comment: </label>
          <input type="text" name="newComment" id="newComment" value="<?php echo $row[4]; ?>"><br/>
          <input type="hidden" name="reviewID" id="reviewID" value="<?php echo $row[0]; ?>">
        </div>

        <input type="submit" value="Update">
      </center>
    </form>
</div>
        </body>
        </html>
