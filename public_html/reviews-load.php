<?php
    include 'dbh.inc.php';

    //these variables track how many reviews have loaded and for which type of product
    $newReviewCount = $_POST['newReviewCount'];
    $prod_id = $_POST['prod_id'];
    $sql='';
    $output='';

    //condition for one specific item's reviews
    if($prod_id==1 || $prod_id==2 || $prod_id==3 || $prod_id==4)
        $sql = "SELECT * FROM ratings R, users U, inventory I WHERE U.idUsers=R.idUsers AND I.productID=R.productID AND R.productID='".$_POST["prod_id"]."' LIMIT $newReviewCount";

    //condition for all reviews
    else
        $sql = "SELECT * FROM ratings R, users U, inventory I WHERE U.idUsers=R.idUsers AND I.productID=R.productID LIMIT $newReviewCount";

    //remaining code lists the reviews in their proper format based on what is in the database
    $result = $conn->query($sql);
    if($result-> num_rows > 0)
    {
        while($row = $result -> fetch_assoc())
        {
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
    else
        echo "There are currently no reviews!".$prod_id;

    $conn->close();
?>
