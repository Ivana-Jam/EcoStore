<?php
    //begin session
    session_start();
    require "dbh.inc.php";

    //This PHP function will refresh this page if the Delete button is hit,
    //this time without the corresponding review
    if(isset($_GET['Delete']))
    {
        $rid = $_GET['Delete'];
        $res=mysqli_query($conn, "SELECT * FROM ratings WHERE ratingID='$rid'");
        $row = mysqli_fetch_array($res);

        $sql = "DELETE FROM ratings WHERE ratingID='$rid'";

        if($result= mysqli_query($conn, $sql)) {
            echo "Review Deleted successfully! <br><br>";
        }

        else {
            echo "Unable to delete review! <br><br>";
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
    </head>

    <body>
        <div class="container">
            <h1>Eco Mall</h1>

            <!--Navigation bar for the top of each page-->
            <div class="nav">
                <nav>
                    <table align = "center">
                    <tr>
                    <td><a href="index.html">Home</a></td>
                    <td><a href="loginHeader.php">Login/Logout</a></td>
                    <td><a href="signup.php">Sign Up</a></td>
                    <td><a href="index.html">About</a></td>
                    <td><a href="shop.php">Products</a></td>
                    <td><a href="contact.php">Contact Us</a></td>
                    <td><a href="reviews-all.php">Reviews</a></td>
                    <td><a href="reviews-myreviews.php">My Reviews</a></td>
                    </tr>
                    </table>
                </nav>
            </div>

            <hr>
            <h1 class="main-heading">My Reviews</h1>
            <hr><br>

            <?php

                //first condition checks if the user is logged in
                if (isset($_SESSION['id'])) {
                    $thisID = $_SESSION['id'];
                    $sql = "SELECT * FROM ratings R, users U, inventory I WHERE R.idUsers='$thisID' AND I.productID=R.productID AND R.idUsers=U.idUsers";
                    $result = $conn->query($sql);

                    //if they are logged in, list ONLY the user's reviews
                    if($result-> num_rows > 0) {
                        while($row = $result -> fetch_assoc()) {
                            echo '<div class="review-header">';
                            echo '<div class="title">'.$row['productName'].'</div>';
                            echo '<div class="rating">'.$row['Rating'].'/5</div>';

                            echo '<div class="item">';
                            echo '<div class="description">';
                            echo '<span>'.$row['comment'].'</span>';
                            echo "</div>";
                            echo '<div class="author">';
                            echo '<span>- '.$row['uidUsers'].'</span>';
                            echo "</div>";

                            echo "<a href='reviews-edit.php?Edit=$row[ratingID]'  class='clickme'>Edit</a>";
                            echo "<a href='reviews-myreviews.php?Delete=$row[ratingID]'  class='clickme'>Delete</a>";

                            echo "</div>";
                            if($row['productID']==1)
                                echo "<img class='resize' src='boxed-Water.jpg' alt='box water'>";
                            else if($row['productID']==2)
                                echo "<img class='resize' src='bamboo.jpg' alt='cutlery'>";
                            else if($row['productID']==3)
                                echo "<img class='resize' src='coffee.jpg' alt='coffee'>";
                            else if($row['productID']==4)
                                echo "<img class='resize' src='soap.jpg' alt='soap'>";
                            echo "</div>";
                        }
                    }
                    else {
                        echo "There are currently no reviews!";
                    }

                    echo "<a href='reviews-new.php' class='clickme'> Write a Review </a>";
                    $conn->close();
                }

                //If user is not logged in, they cannot access the reviews
                else if (!isset($_SESSION['id'])) {
                    echo '<br><br><br><hr><h1 class="main-heading">Whoops!</h1><hr>';
                    echo "Looks like you need to log in to access this feature!";
                    echo '<br><br><a href="loginHeader.php">Login Now</a>';
                }
            ?>
        </div>
    </body>
</html>
