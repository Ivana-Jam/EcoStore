<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Contact Us</title>

    <!--CSS Style Sheet-->
    <link rel="stylesheet" type="text/css" href="contact.css?v=<?php echo time(); ?>">

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!--TINYMCE-->
    <script src="https://cdn.tiny.cloud/1/qrcozjz7l1jua34j7bxytq22ucprsrzwxrwavotiig122d9j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>

    <body>
      <header>
        <h1>Eco Mall</h1>
        <div class="nav">
          <nav>
            <table align = "center">
              <tr>
                <td><a href="index.html">Home</a></td>
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
      </header>

      <main>
        <div class="container">


          <div class ="contactpage">

              <div class="header">
                <h1>Contact Us</h1>
                  <p>
                    Please use the form below if you have any questions
                    regarding any of our products or services. Thank you!
                  </p>
              </div>

            <div class="form">
                <form class="contact-form" action="../private_html/contactform.php" method="post">
                  <input type="text" name="name" placeholder="Name">
                  <input type="text" name="email" placeholder="Email">
                  <input type="text" name="subject" placeholder="Subject">
                  <textarea name="msg" placeholder="Message"></textarea>
                  <button type="submit" name="submit">Let's Talk</button>
                </form>
              </div>
          </div>
      </main>
    </body>
    <footer>&copy Group34</footer>
  </html>
