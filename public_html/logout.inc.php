<?php
  session_start();
  //deletes all values inside the session variables
  session_unset();
  //Destroy variables
  session_destroy();
  header("Location: index2.php");
 ?>
