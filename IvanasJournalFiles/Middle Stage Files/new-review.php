<?php
    session_start();
    require 'dbh.inc.php';

    if(isset($_SESSION['id']))
    {
        $uid = $_SESSION['id'];
        if(isset($_POST['save'])) {
            $RID = $conn->real_escape_string($_POST['RID']);
            $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
            $ratedIndex++;

            if(!$RID)
            {
                $conn-> query("INSERT INTO ratings VALUES (NULL, '$uid', '1', '$ratedIndex', '')");
                $sql = $conn->query("SELECT ratingID FROM ratings ORDER BY ratingID DESC LIMIT 1");
                $uData = $sql->fetch_assoc();
                $RID = $uData['ratingID'];

            }

            else
                $conn->query("UPDATE ratings SET Rating = '$ratedIndex' WHERE ratingID='$RID'");
               
            exit(json_encode(array('ratingID' => $RID)));
        
        }
    }
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

        <form action = "sub-review.php?RID=$row[ratingID]" method="post">
          <center>

        <h1>Add Review</h1>


        <label> Please select a product: </label>
        <select name="product_name">
          <option>---PRODUCT---</option>
          <option value="Boxed Water">Boxed Water</option>
          <option value="Wooden Cutlery">Wooden Cutlery</option>
          <option value="Reuseable Coffee Capsules">Reuseable Coffee Capsules</option>
          <option value="Eco Soap">Eco Soap</option>
        </select>

        <div align="center" style=" padding: 10px;">
            <i class="fa fa-star fa-2x" style="color: #fff7f8" data-index="0"></i>
            <i class="fa fa-star fa-2x" style="color: #fff7f8" data-index="1"></i>
            <i class="fa fa-star fa-2x" style="color: #fff7f8" data-index="2"></i>
            <i class="fa fa-star fa-2x" style="color: #fff7f8" data-index="3"></i>
            <i class="fa fa-star fa-2x" style="color: #fff7f8" data-index="4"></i>
            <br><br>
          
        </div>

        <div>
          <label for="comment">Comment: </label>
          <input type="text" name="comment" id="comment" required="required">
        </div>
        <input type="submit" value="Submit">
               </div>

      </center>

    </form>
</div>
<!--Ajax-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-3.4.0.min.js"></script>
<script>

    var ratedIndex = -1, RID=0;

    $(document).ready(function () {
        resetStarColours();
        
        if(localStorage.getItem('ratedIndex') != null)
        {
            setStars(parseInt(localStorage.getItem('ratedIndex')));
            RID = localStorage.getItem('RID');
        }
        
        $('.fa-star').on('click', function() {
            ratedIndex = parseInt($(this).data('index'));
            localStorage.setItem('ratedIndex', ratedIndex);
            saveToDB();

        });

        $('.fa-star').mouseover(function () {
            resetStarColours();
            var currentIndex = parseInt($(this).data('index'));
            setStars(currentIndex);
                
        });
        
        $('.fa-star').mouseleave(function () {
            resetStarColours();
            if(ratedIndex != -1)
            {
                setStars(ratedIndex);
            }

        });
    });
    
    function saveToDB() {
        $.ajax({
            url: "new-review.php",
            method: "POST",
            dataType: 'json',
            data: {
                'save': 1,
                'RID': RID, 
                'ratedIndex': ratedIndex
            }, success: function(r) {
                RID = r.ratingID;
                localStorage.setItem('RID', RID);
            }
        });
    }
    
    function setStars(max) {
        for(var i=0; i<=max; i++)
        {
        $('.fa-star:eq('+i+')').css('color', 'pink');
        }
    }
    
    
    function resetStarColours() {
        $('.fa-star').css('color', '#fff7f8');
        
    }
    
</script>

        </body>
        </html>