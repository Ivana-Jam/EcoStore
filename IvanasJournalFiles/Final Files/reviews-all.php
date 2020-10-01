<?php
    //begin session
    session_start();
    require 'dbh.inc.php';
    
    //This function fills the dropdown menu with a list of all products that the store sells
    function fill_brand($conn)
    {
        $output = '';
        $sql = "SELECT * FROM inventory";
        $result=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_array($result))
        {
            $output.='<option value="'.$row["productID"].'">'.$row["productName"].'</option>';
        }
        return $output;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>AllReviews</title>
        <!--CSS Stylesheet-->
        <link rel="stylesheet" href="reviews.css"/>
        <!--Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"/>
        <!--Ajax-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    </head>

    <body>
        <div class="container">
            <h1>Eco Mall</h1>
            <!--Navigation bar for the top of each page-->
            <div class="nav">
                <nav>
                    <table align = "center">
                    <tr>
                    <td><a href="loginHeader.php">Login</a></td>
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
            <h1 class="main-heading">Reviews</h1>
            <hr><br>

            <!--The brand tag will be what triggers jQuery code later to only show certain reviews-->
            <select name="brand" id="brand">
                <!--Here a drop down menu is created and filled with a list of products-->
                <option value="">Show All Products</option>
                <?php echo fill_brand($conn); ?>
            </select>

            <div id="reviews">
            <!--This PHP code will reveal the first two reviews-->
            <?php
                $sql = "SELECT * FROM ratings R, users U, inventory I WHERE U.idUsers=R.idUsers AND I.productID=R.productID LIMIT 2";
                $result = $conn->query($sql);
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
                        echo "</div>";
                        if($row['productID']==1)
                            echo "<img class='resize' src='img1.jpg' alt='box water'>";
                        else if($row['productID']==2)
                            echo "<img class='resize' src='img2.jpg' alt='cutlery'>";
                        else if($row['productID']==3)
                            echo "<img class='resize' src='img3.jpg' alt='coffee'>";
                        else if($row['productID']==4)
                            echo "<img class='resize' src='img4.jpg' alt='soap'>";
                        echo "</div>";
                        
                    }
                }
                else {
                    echo "There are currently no reviews!";
                }
                $conn->close();
            ?> 
            </div>
        </div>

        <button class="cool-button">Load More Reviews</button>
    </body>
</html>
  
<script>
    //jQuery code
    var prod_id;    //this variable tracks which product to display reviews for
    
    //This function uses ajax to load two additional reviews every time the "Load More Reviews" button is clicked
    $(document).ready(function() {
        var reviewCount = 2;
        $("button").click(function() {
            reviewCount = reviewCount + 2;
            $("#reviews").load("reviews-load.php", {
                prod_id:prod_id,
                newReviewCount: reviewCount
            });
        });
    });
  
    //This function uses ajax to show only the reviews for the selected product
    //it also loads two additional reviews every time the "Load More Reviews" button is clicked
    $(document).ready(function() { 
        var reviewCount = 2;
         $('#brand').change(function(){
            prod_id = $(this).val();
            $("#reviews").load("reviews-load.php", {
                prod_id:prod_id,
                newReviewCount: reviewCount
            });
        });
    });
        
</script>