<?php
    include 'dbh.inc.php';
    $newReviewCount = $_POST['newReviewCount'];
    $prod_id = $_POST['prod_id'];
    $sql='';
    $output='';

    if($prod_id==1 || $prod_id==2 || $prod_id==3 || $prod_id==4)
    {
            $sql = "SELECT * FROM ratings R, users U, inventory I WHERE U.idUsers=R.idUsers AND I.productID=R.productID AND R.productID='".$_POST["prod_id"]."' LIMIT $newReviewCount";
    }
    
    else
    {
            $sql = "SELECT * FROM ratings R, users U, inventory I WHERE U.idUsers=R.idUsers AND I.productID=R.productID LIMIT $newReviewCount";
    }
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
      echo "There are currently no reviews!".$prod_id;
}


$conn->close();


?>