<?php
    session_start();
    require 'dbh.inc.php';
    $RID;
    if(isset($_GET['Edit']))
        {
            $rid = $_GET['Edit'];
            $res=mysqli_query($conn, "SELECT * FROM ratings WHERE ratingID='$rid'");
            $row = mysqli_fetch_array($res);
            $RID = $row[0];
        }   
            
            if(isset($_POST['save'])) {
                 $RID = $conn->real_escape_string($_POST['RID']);
                 $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
            $ratedIndex++;
             $sql = "UPDATE ratings SET Rating ='$ratedIndex' WHERE ratingID='$RID'";
          
          if($result= mysqli_query($conn, $sql))
            {
              header('Location: http://ecomall.jaminai.myweb.cs.uwindsor.ca/myReviews.php');
            }
            else {
              echo "Unable to post review! <br>";
            }
        
            }

        

       
      if(isset($_POST['newComment']))
      {
          $newComment = filter_var($_POST['newComment'], FILTER_SANITIZE_STRING);
          $rid = $_POST['reviewID'];
          $sql = "UPDATE ratings SET comment = '$newComment' WHERE ratingID='$rid'";
          
          if($result= mysqli_query($conn, $sql))
            {
              header('Location: http://ecomall.jaminai.myweb.cs.uwindsor.ca/myReviews.php');
            }
            else {
              echo "Unable to post review! <br>";
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

        <form action = "edit-review.php" method="post">
          <center>

        <h1>Edit Review</h1>
        
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
          <input type="text" name="newComment" id="newComment" value="<?php echo $row[4]; ?>"><br/>
          <input type="hidden" name="reviewID" id="reviewID" value="<?php echo $row[0]; ?>"><br/>
          <input type="hidden" name="numStars" id="numStars" value="<?php echo $row[3]; ?>">
        </div>

        <input type="submit" value="Update">
      </center>
   </form>

<script src="http://code.jquery.com/jquery-3.4.0.min.js"></script>
<script>

    var ratedIndex = -1, RID = "<?php echo $row[0]; ?>" ;

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
 
 </div>

        </body>
        </html>