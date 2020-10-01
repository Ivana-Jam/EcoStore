<?php
$dBServername = "localhost";
$dBUsername = "YOUR_DBUSERNAME";
$dBPassword = "YOUR_DBPASSWORD";
$dBName = "YOUR_DBNAME";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
