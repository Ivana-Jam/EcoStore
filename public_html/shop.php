<?php
  session_start();
  require "dbh.inc.php";
?>
<html>
  <head>
    <title>Shop</title>
    <!--CSS Stylesheet-->
    <link rel="stylesheet" type="text/css" href="shop.css" />

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/dfd3ed979b.js" crossorigin="anonymous"></script>
  </head>
  <body>
      <div class="container">
        <h1>Eco Mall</h1>
        <div class="nav">
          <nav>
            <table align = "center">
              <tr>
                <td><a href="index.html">Home</a></td>
                <td><a href="loginHeader.php">Logout</a></td>
                <td><a href="signup.php">Signup</a></td>
                <td><a href="index.html">About</a></td>
                <td><a href="shop.php">Products</a></td>
                <td><a href="contact.php">Contact Us</a></td>
                <td><a href="reviews-all.php">Reviews</a></td>
                <td><a href="reviews-myreviews.php">My Reviews</a></td>
                <!-- this is for the cart button-->
                <td><nav class="navbar">
                  <div class="navbar-center">
                  <div class="cart-btn">
                    <span class = "navbar">
                    <i class = "fas fa-cart-plus"></i>
                  </span>
                  <div class="cart-items">0</div>
                </div>
              </div>
                </nav>
                <!--End of cart button-->
              </td>
              </tr>
            </table>
          </nav>
        </div>
      </div>
    <?php
        //If user is not logged in, they cannot access the shop
        if (!isset($_SESSION['id'])) {
          echo '
          <div class="no-access">
          <h3>Oops! Looks like you are not logged in.</h3>
          <h3>Please log in to enjoy shopping our eco-friendly collection!</h3>
                <a href="loginHeader.php"><button class = "login banner-btn">Login Now</button></a>
          </div>';
        }
        else {echo'
        <!-- products -->
        <section class="products">
          <div class="products-center">
          </div>
        </section>
        <!-- end of products -->
        <!-- cart -->
        <div class="cart-overlay">
          <div class="cart">
            <span class="close-cart"><i class="far fa-window-close"></i></span>
            <h2>your cart</h2>
            <div class="cart-content">
            </div>
            <div class="cart-footer">
              <h3>your total : $<span class="cart-total">0</span></h3>
              <table>
                  <tr>
                      <td>
                        <button class="clear-cart banner-btn">clear cart</button>
                      </td>
                      <td>
                        <button class="place-order banner-btn">place order</button>
                      </td>
                  </tr>
              </table>
            </div>
          </div>
        </div>
        <!-- end of cart -->
        <!--  javascript -->
        <script src="shop.js"></script>
        ';}
        ?>
  </body>
</html>
