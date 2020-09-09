<?php
include("config.php");
session_start();

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the data from the form
$email = mysqli_real_escape_string($conn,$_POST['email_input_login']);
$password = mysqli_real_escape_string($conn,$_POST['password_input_login']);

// Create the query
$sql = "SELECT id,firstname,lastname,type,email FROM users WHERE `email`='$email' AND `password`='$password'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

// Check for existing user in db
if (mysqli_num_rows($result) == 1) {
  // If user exists, define session parameters and go to home page
  $_SESSION["id"] = $row["id"];
  $_SESSION["firstname"] = $row["firstname"];
  $_SESSION["lastname"] = $row["lastname"];
  $_SESSION["type"] = $row["type"];
  $_SESSION["email"] = $row["email"];
  if($row["type"]=="Employee") {
    header("Location: /home.php");
  } elseif ($row["type"]=="Admin") {
    header("Location: /admin_home.php");
  }

} else {
  // If user does not exist destroy session

  // Remove all the session variables
  session_unset();

  // Destroy the session
  session_destroy();

  // Go to Login Error page
  header("Location: /error_pages/error_login.php");
}

// Close the connection to the db
$conn->close();
?>
