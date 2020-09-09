<?php
include("config.php");
session_start();

// Employee users are not allowed to enter this page
if($_SESSION["type"]=="Employee") {
  header("Location: /error_pages/error_404.php");
  exit;
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the data from the form and the session
$firstname = $_POST["firstname_input"];
$lastname = $_POST["lastname_input"];
$email = $_POST["email_input"];
$password = $_POST["password_input"];
$type = $_POST["type_input"];

// Create the query
$sql = "INSERT INTO users(firstname, lastname, email, password, type) VALUES ('$firstname', '$lastname', '$email', '$password', '$type')";

// Execute the insert query
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  header("Location: /admin_home.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the db connection
$conn->close();
?>
