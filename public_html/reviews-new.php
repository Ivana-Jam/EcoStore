<?php
    //begin session
    /*session_start();
    require 'dbh.inc.php';

    //first condition checks if the user is logged in
    if(isset($_SESSION['id']))
    {
        $uid = $_SESSION['id'];

        //this condition is activated by ajax when the user clicks on the stars
        if(isset($_POST['save'])) {
            //get reviwID and number of stars from temporary data
            $RID = $conn->real_escape_string($_POST['RID']);
            $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
            $ratedIndex++;

            //if reviewID is not set yet (ie review is completely new) create a new entry in the database
            if(!$RID)
            {
                $conn-> query("INSERT INTO ratings VALUES (NULL, '$uid', '1', '$ratedIndex', '')");
                $sql = $conn->query("SELECT ratingID FROM ratings ORDER BY ratingID DESC LIMIT 1");
                $uData = $sql->fetch_assoc();
                $RID = $uData['ratingID'];

            }

            //else get the last entry
            else
                $conn->query("UPDATE ratings SET Rating = '$ratedIndex' WHERE ratingID='$RID'");

            //return reviewID
            exit(json_encode(array('ratingID' => $RID)));

        }
    }

*/
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Reviews</title>
        <!--CSS Stylesheet-->
        <link rel="stylesheet" type="text/css" href="reviews.css" />
        <!--Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"/>
        <!--Font Awesome-->
        <script src="https://kit.fontawesome.com/dfd3ed979b.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/releases/v5.8.1/css/all.css"></script>
    </head>

    <body>
        <div class="container">
            <div id="rating">
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

                <!--execute reviews-new-submit when the form is submitted-->
                <form action = "reviews-new-submit.php" method="post">
                    <center>

                        <hr>
                        <h1 class="main-heading">Add Review</h1>
                        <hr><br>

                        <!--add in drop down menu -->
                        <label> Please select a product: </label><br>
                        <select name="product_name">
                            <option>---PRODUCT---</option>
                            <option value="Boxed Water">Boxed Water</option>
                            <option value="Wooden Cutlery">Wooden Cutlery</option>
                            <option value="Reuseable Coffee Capsules">Reuseable Coffee Capsules</option>
                            <option value="Eco Soap">Eco Soap</option>
                        </select><br><br><br><br>

                        <!--add in star rating system -->
                        <label> Please select a rating out of 5: </label><br>
                        <input id="star-rating" name="ratedIndex" type="hidden" />
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
                            <input type="text" size="50" name="comment" id="comment" required="required">
                        </div><br><br>

                        <input class="clickme" type="submit" value="Submit">
                    </center>
                </form>
            </div>
        </div>

        <script src="http://code.jquery.com/jquery-3.4.0.min.js"></script>
        <script>

        //these variable keep track of the reviewID and the rating
        var ratedIndex = -1, RID=0;

        //the functions below are used to animate the stars and record the rating based on user mouse clicks
        $(document).ready(function () {
            resetStarColours();

            if(localStorage.getItem('ratedIndex') != null) {
                //setStars(parseInt(localStorage.getItem('ratedIndex')));
                //RID = localStorage.getItem('RID');
            }

            $('.fa-star').on('click', function() {
                ratedIndex = parseInt($(this).data('index'));
                //localStorage.setItem('ratedIndex', ratedIndex);
                //saveToDB();
                $('#star-rating').val(parseInt($(this).data('index')));
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
                url: "reviews-new.php",
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

    </body>
</html>
