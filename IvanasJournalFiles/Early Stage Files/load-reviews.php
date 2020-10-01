<?php
    include 'dbh.inc.php';
    $newReviewCount = $_POST['newReviewCount'];

    $sql = "SELECT * FROM ratings R, users U, inventory I WHERE U.idUsers=R.idUsers AND I.productID=R.productID LIMIT $newReviewCount";
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
