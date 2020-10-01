<?php
    require 'dbh.inc.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>AllReviews</title>
    <link rel="stylesheet" href="reviews.css"/>
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <script>
        //jQuery code
        $(document).ready(function() {
            var reviewCount = 2;
            $("button").click(function() {
                reviewCount = reviewCount + 2;
                $("#reviews").load("load-reviews.php", {
                    newReviewCount: reviewCount
                });
            });
        });
    </script>


  </head>

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

      <h1>Reviews</h1>


<div id="reviews">
<?php


$sql = "SELECT * FROM ratings R, users U, inventory I WHERE U.idUsers=R.idUsers AND I.productID=R.productID LIMIT 2";
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
            echo '</div>';
        echo "</div>";
    }

}
else {
      echo "There are currently no reviews!";

}


$conn->close();


?>

</div>
<button>Load More Reviews</button>


  </body>
  </html>
