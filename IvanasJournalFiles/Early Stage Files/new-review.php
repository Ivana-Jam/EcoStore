<?php
    require 'dbh.inc.php';

    if(isset($_POST['submit']))
    {
      $uid = $_SESSION['id'];
      switch($_POST['product_name'])
      {
        case "Boxed Water": $pid = 1; break;
        case "Wooden Cutlery": $pid = 2; break;
        case "Reuseable Coffee Capsules": $pid = 3; break;
        case "Eco Soap": $pid = 4; break;
      }
      switch($_POST['rating_num'])
      {
        case "1": $rate = 1; break;
        case "2": $rate = 2; break;
        case "3": $rate = 3; break;
        case "4": $rate = 4; break;
        case "5": $rate = 5; break;
      }
      $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

      $query = "INSERT INTO ratings VALUES (NULL, '$uid', '$pid', '$rate', '$comment')";

      if($result= mysqli_query($conn, $query))
      {
        echo "Review posted successfully! <br>";
        $conn->commit();
      }
      else {
        echo "Unable to post review! <br>";
      }
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Add Reviews</title>
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

        <form method="post">
          <center>

        <h1>Add Review</h1>

        <label> Please select a product: </label>
        <select name="product_name">
          <option>---PRODUCT---</option>
          <option value="Boxed Water">Boxed Water</option>
          <option value="Wooden Cutlery">Wooden Cutlery</option>
          <option value="Reuseable Coffee Capsules">Reuseable Coffee Capsules</option>
          <option value="Eco Soap">Eco Soap</option>
        </select>

        <label> Please select a rating: </label>
        <select name="rating_num">
          <option>---RATING---</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>

        <div>
          <label for="comment">Comment: </label>
          <input type="text" name="comment" id="comment" required="required">
        </div>

        <button type="submit" name="Submit">Submit</button>
      </center>
    </form>
        <?php
        ?>
        </body>
        </html>
