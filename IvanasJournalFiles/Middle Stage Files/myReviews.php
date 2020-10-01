<?php
session_start();
  require "dbh.inc.php";
  
  if(isset($_GET['Delete']))
    {
      $rid = $_GET['Delete'];
    $res=mysqli_query($conn, "SELECT * FROM ratings WHERE ratingID='$rid'");
      $row = mysqli_fetch_array($res);
      
      $sql = "DELETE FROM ratings WHERE ratingID='$rid'";

          if($result= mysqli_query($conn, $sql))
            {
              echo "Review Deleted successfully! <br>";

            }
            else {
              echo "Unable to delete review! <br>";
            }

    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>My Reviews</title>
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

        <h1>My Reviews</h1>
        <?php


        if (isset($_SESSION['id'])) {
        $thisID = $_SESSION['id'];
        $sql = "SELECT * FROM ratings R, users U, inventory I WHERE R.idUsers='$thisID' AND I.productID=R.productID AND R.idUsers=U.idUsers";
        $result = $conn->query($sql);

        if($result-> num_rows > 0)
        {
            while($row = $result -> fetch_assoc())
            {
                echo '<div class="review-header">';
                    echo '<div class="title">'.$row['Rating'].'</div>';

                    echo '<div class="item">';
                        echo '<div class="description">';
                            echo '<span>'.$row['comment'].'</span>';
                        echo '</div>';
                        echo "<a href='edit-review.php?Edit=$row[ratingID]' >Edit</a>";
                        echo "<a href='myReviews.php?Delete=$row[ratingID]' >Delete</a>";
                    echo '</div>';
                echo "</div>";
            }

        }
        else {
              echo "There are currently no reviews!";

        }

        echo '<button> Write a Review </button>';
        $conn->close();

      }
      
              //If user is not logged in, they cannot access the shop
        else if (!isset($_SESSION['id'])) {
          echo '<h3>Login to access your reviews</h3>
                <a href="loginHeader.php">Login Now</a>';
        }
  ?>
          </body>
          </html>