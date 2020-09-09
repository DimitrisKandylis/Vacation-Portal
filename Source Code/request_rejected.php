<?php
include("config.php");
session_start();

// Employee users are not allowed to enter this page
if($_SESSION["type"]=="Employee") {
  header("Location: /error_pages/error_404.php");
  exit;
}

// Check if sesion exists. Else go to Login page
if($_SESSION["firstname"]==null) {
  header("Location: /");
  exit;
}

// Employee users are not allowed to enter this page
if($_SESSION["type"]=="Employee") {
  header("Location: /error_pages/error_404.php");
}

// Get the id of the specific request
$request_to_be_rejected_id = $_GET['request'];

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create the query
$sql = "UPDATE applications SET `req_status`='rejected' WHERE `id`='$request_to_be_rejected_id'";

// Execute the insert query
if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Create the query and get the submitted date from the db
$sql2 = "SELECT date_submitted FROM applications WHERE `id`='$request_to_be_rejected_id'";
$result = $conn->query($sql2);
$row = mysqli_fetch_array($result);
$date = $row["date_submitted"];

// Create the parameters for the email
// For testing purposes I send the email to dimitris_tester@yahoo.com
// Otherwise it would have been like this:
/*
$query3 = "SELECT user_id FROM applications WHERE id='". $request_to_be_rejected_id ."'";
$result = $conn->query($query3);
$row = mysqli_fetch_row($result);
$rejected_user_id = $row[0];
$query4 = "SELECT email FROM users WHERE id='". $rejected_user_id ."'";
$result = $conn->query($query4);
$row = mysqli_fetch_row($result);
$rejected_user_email = $row[0];
$to_mail = strval($rejected_user_email);
*/

$to_email = 'dimitris_tester@yahoo.com';
$subject = 'Vacation Portal - Application Rejected';
$message = "Dear employee, your supervisor has rejected your application submitted on ". $date;
$headers = 'From: dimitris_tester@yahoo.com';
mail($to_email,$subject,$message,$headers);

header("Location: /rejection.php");

// Close the db connection
$conn->close();
exit;
?>
