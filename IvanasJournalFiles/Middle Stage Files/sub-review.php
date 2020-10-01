<?php
session_start();
require 'dbh.inc.php';

    if(isset($_SESSION['id']))
    {
      $uid = $_SESSION['id'];
      switch($_POST['product_name'])
      {
        case "Boxed Water": $pid = 1; break;
        case "Wooden Cutlery": $pid = 2; break;
        case "Reuseable Coffee Capsules": $pid = 3; break;
        case "Eco Soap": $pid = 4; break;
      }
      
      $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
      
        $sql = $conn->query("SELECT ratingID FROM ratings ORDER BY ratingID DESC LIMIT 1");
        $uData = $sql->fetch_assoc();
        $RID = $uData['ratingID'];

      $query = "UPDATE ratings SET productID = '$pid', comment='$comment' WHERE ratingID='$RID'";

      if($result= mysqli_query($conn, $query))
      {
        echo "Review posted successfully! <br>";
        $conn->commit();
      }
      else {
        echo "Unable to post review! <br>";
      }
    
}



?>