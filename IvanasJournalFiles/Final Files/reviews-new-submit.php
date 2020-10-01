<?php
    //begin session
    session_start();
    require 'dbh.inc.php';

    //first condition checks if the user is logged in
    if(isset($_SESSION['id']))
    {
        $uid = $_SESSION['id'];

        //switch statement sets the product ID of the new review entry based on what the usere entered previously
        switch($_POST['product_name'])
        {
            case "Boxed Water": $pid = 1; break;
            case "Wooden Cutlery": $pid = 2; break;
            case "Reuseable Coffee Capsules": $pid = 3; break;
            case "Eco Soap": $pid = 4; break;
        }

        //filter through the use-entered comments
        $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

        //get number of stars and increment to get number of stars from star index
        $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
        $ratedIndex++;

        //get the last entry from the reviews database
        //this entry will already have the rating, user id, and rating is filled out
        //$sql = $conn->query("SELECT ratingID FROM ratings ORDER BY ratingID DESC LIMIT 1");
        //$uData = $sql->fetch_assoc();
        //$RID = $uData['ratingID'];

        //insert comment and product ID values in the database
        $query = "INSERT INTO ratings VALUES (NULL, '$uid', '$pid', '$ratedIndex', '$comment')";

        //$query = "UPDATE ratings SET productID = '$pid', comment='$comment' WHERE ratingID='$RID'";

        if($result= mysqli_query($conn, $query)){
            echo '<br><br><br><hr><h1 class="main-heading">Hooray!</h1><hr>';
            echo "You successfully posted a review!";
            echo '<br><br><a href="reviews-myreviews.php">Return to My Reviews</a>';
            $conn->commit();
        }

        else {
            echo "<br><br><br><hr><h1 class='main-heading'>Whoops!</h1><hr>";
            echo "Looks like we were unable to process this request!";
            echo '<br><br><a href="reviews-myreviews.php">Return to My Reviews</a>';
        }
    }
?>