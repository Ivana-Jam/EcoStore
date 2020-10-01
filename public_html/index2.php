<?php
  require "loginHeader.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">

          <?php

          //if we don't have the session variables set in the website then the user is logged in

          if (!isset($_SESSION['id'])) {
            echo '<h3 class="login-status">You are logged out!</h3>';
          }
          //if we have the session variables set in the website then the user is logged in
          //Display shop message
          else if (isset($_SESSION['id'])) {
            echo'<h1>Now you can shop!</h1>';
            echo '<h3 class="login-status">You are logged in!</h3>';
          }
          ?>
        </section>
      </div>
    </main>

<?php
  require "footer.php";
?>
