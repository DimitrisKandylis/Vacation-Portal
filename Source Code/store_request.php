<?php
include("config.php");
session_start();

// Admin users cannot enter this page
if($_SESSION["type"]=="Admin") {
  header("Location: /error_pages/error_404.php");
  exit;
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the data from the form and the session
$date_from = $_POST["date_from_input"];
$date_to = $_POST["date_to_input"];
$reason = $_POST["reason_input"];
$date_submitted = date("Y/m/d");
$request_status = "pending";
$user_id = $_SESSION["id"];
$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];

// Create the query
$sql = "INSERT INTO applications(user_id, date_submitted, date_from, date_to, reason, req_status) VALUES ('$user_id', '$date_submitted', '$date_from', '$date_to', '$reason', '$request_status')";

// Execute the insert query
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Get the max id from the db
$query2 = "SELECT MAX(`id`) FROM applications WHERE `user_id`='$user_id'";
$result = $conn->query($query2);
$row = mysqli_fetch_row($result);
$new_request_id = $row[0];

// Create the parameters for the email
$approve_link = 'http://localhost/request_approved.php?request='.$new_request_id;
$reject_link = 'http://localhost/request_rejected.php?request='.$new_request_id;

// For testing purposes I send the email to dimitris_tester@yahoo.com
// Otherwise it would have been like this:
/*
$query3 = "SELECT email FROM users WHERE type='Admin'";
$result = $conn->query($query3);
$row = mysqli_fetch_row($result);
$to_mail = strval($row[0]);
*/

$to_email = 'dimitris_tester@yahoo.com';
$subject = 'Vacation Portal - Application Request';
$message = "Dear supervisor, employee ". $lastname ." ". $firstname ." requested for some time off, starting on ". $date_from ." and ending on ". $date_to .", stating the reason: ". $reason ."
Click on one of the below links to approve or reject the application: ".
$approve_link ." - ". $reject_link;
$headers = 'From: dimitris_tester@yahoo.com';
mail($to_email,$subject,$message,$headers);

header("Location: /home.php");

// Close the db connection
$conn->close();
exit;
?>
