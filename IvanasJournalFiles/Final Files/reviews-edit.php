<?php
    //begin session
    session_start();
    require 'dbh.inc.php';

    $RID;
    //if edit was hit the review ID can be extracted from this request
    if(isset($_GET['Edit'])) {
        $rid = $_GET['Edit'];
        $res=mysqli_query($conn, "SELECT * FROM ratings WHERE ratingID='$rid'");
        $row = mysqli_fetch_array($res);
        $RID = $row[0];
    }

    //if the star rating was changed, these variables are used to update the rating appropriated in the DB
  /*  if(isset($_POST['save'])) {
        $RID = $conn->real_escape_string($_POST['RID']);
        $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
        $ratedIndex++;
         $sql = "UPDATE ratings SET Rating ='$ratedIndex' WHERE ratingID='$RID'";

        if($result= mysqli_query($conn, $sql)) {
            header('Location: http://ecomall.jaminai.myweb.cs.uwindsor.ca/reviews-myreviews.php');
        }
        else {
            echo "<br><br><br><hr><h1 class='main-heading'>Whoops!</h1><hr>";
            echo "Looks like we were unable to process this request!";
            echo '<br><br><a href="reviews-myreviews.php">Return to My Reviews</a>';
        }
    }*/

    //once the edits are submitted, all changed are recorded and user is rturned to thir reviews page
    if(isset($_POST['newComment']))  {
        $newComment = filter_var($_POST['newComment'], FILTER_SANITIZE_STRING);
        $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
        $ratedIndex++;
        $rid = $_POST['reviewID'];
        $sql = "UPDATE ratings SET comment = '$newComment', Rating = '$ratedIndex' WHERE ratingID='$rid'";

        if($result= mysqli_query($conn, $sql)) {
            header('Location: http://ecomall.jaminai.myweb.cs.uwindsor.ca/reviews-myreviews.php');
        }
        else {
            echo "<br><br><br><hr><h1 class='main-heading'>Whoops!</h1><hr>";
            echo "Looks like we were unable to process this request!";
            echo '<br><br><a href="reviews-myreviews.php">Return to My Reviews</a>';
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
    </head>

    <body>
        <div class="container">
            <h1>Eco Mall</h1>
            <div class="nav">
                <!--Navigation bar for the top of each page-->
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

            <!--execute reviews-edit when the form is submitted-->
            <form action = "reviews-edit.php" method="post">
                <center>

                    <hr>
                    <h1 class="main-heading">Edit Review</h1>
                    <hr><br>

                    <!--add in star rating system -->
                    <label> Please select a rating out of 5: </label><br>
                    <div align="center" style=" padding: 10px;">
                        <i class="fa fa-star fa-2x" style="color: #fff7f8" data-index="0"></i>
                        <i class="fa fa-star fa-2x" style="color: #fff7f8" data-index="1"></i>
                        <i class="fa fa-star fa-2x" style="color: #fff7f8" data-index="2"></i>
                        <i class="fa fa-star fa-2x" style="color: #fff7f8" data-index="3"></i>
                        <i class="fa fa-star fa-2x" style="color: #fff7f8" data-index="4"></i>
                        <br><br>
                    </div><br><br>

                    <!--add in a comments box-->
                    <div>
                        <label for="comment">Please enter some comments about this product: </label><br>
                        <input type="text" size="50" name="newComment" id="newComment" value="<?php echo $row[4]; ?>"><br/>
                        <input type="hidden" name="reviewID" id="reviewID" value="<?php echo $row[0]; ?>"><br/>
                        <input type="hidden" name="ratedIndex" id="numStars" value="<?php echo $row[3]; ?>">
                    </div>

                    <input class="clickme" type="submit" value="Update">
                </center>
            </form>

            <script src="http://code.jquery.com/jquery-3.4.0.min.js"></script>
            <script>

                //these variable keep track of the reviewID and the rating
                var ratedIndex = <?php echo $row[3]-1; ?>, RID = "<?php echo $row[0]; ?>" ;

                //the functions below are used to animate the stars and record the rating based on user mouse clicks
                $(document).ready(function () {
                    resetStarColours();
                    setStars(parseInt(ratedIndex));

                    if(localStorage.getItem('ratedIndex') != null) {
                        //setStars(parseInt(localStorage.getItem('ratedIndex')));
                        //RID = localStorage.getItem('RID');
                    }

                    $('.fa-star').on('click', function() {
                        ratedIndex = parseInt($(this).data('index'));
                        //localStorage.setItem('ratedIndex', ratedIndex);
                        //saveToDB();
                        $('#numStars').val(ratedIndex);
                    });

                    $('.fa-star').mouseover(function () {
                        resetStarColours();
                        var currentIndex = parseInt($(this).data('index'));
                        setStars(currentIndex);
                    });

                    $('.fa-star').mouseleave(function () {
                        resetStarColours();
                        if(ratedIndex != -1) {
                            setStars(ratedIndex);
                        }
                    });
                });

                /*function saveToDB() {
                    $.ajax({
                        url: "edit-review.php",
                        method: "POST",
                        dataType: 'json',
                        data: {
                            save: 1,
                            RID: RID,
                            ratedIndex: ratedIndex
                        }, success: function(r) {
                            RID = r.ratingID;
                            localStorage.setItem('RID', RID);
                        }
                    });
                }*/

                function setStars(max) {
                    for(var i=0; i<=max; i++) {
                        $('.fa-star:eq('+i+')').css('color', 'pink');
                    }
                }

                function resetStarColours() {
                    $('.fa-star').css('color', '#fff7f8');
                }
            </script>

        </div>
    </body>
</html>