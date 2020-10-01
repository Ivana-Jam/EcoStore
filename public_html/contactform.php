<?php
//If the user hits the "let's talk" button
if (isset($_POST['submit'])) {
  //Obtain the information submitted by user into variables
  $name = $_POST['name'];
  $subject = $_POST['subject'];
  $userEmail = $_POST['email'];
  $message = $_POST['msg'];

  //host email
  $adminEmail = "vanderlb@vanderlb.myweb.cs.uwindsor.ca";
  //Header that is received by the admin for extra information
  $headers = "From: ".$userEmail;
  //Message admin receives in the email
  $txt = "You have received an e-mail from ".$name.".\n\n".$message;
  //mail php function to send information to an email(administrator)
  mail($adminEmail, $subject, $txt, $headers);
  //Take back to contact page with success message in url
  header("Location: contact.php?mailsent");
}
