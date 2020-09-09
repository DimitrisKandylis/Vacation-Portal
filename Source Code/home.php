<?php
include("config.php");
session_start();

// Check if sesion exists. Else go to Login page
if($_SESSION["firstname"]==null) {
  header("Location: /");
  exit;
}

// Admin users cannot enter this page
if($_SESSION["type"]=="Admin") {
  header("Location: /error_pages/error_404.php");
  exit;
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$logged_user = $_SESSION["id"];

// Create the query and get the results from the db
$sql = "SELECT id, date_submitted, date_from, date_to, req_status FROM applications WHERE `user_id`='$logged_user'";
$result = $conn->query($sql);
$vacation_array = array();
while($object = mysqli_fetch_object($result)) {
  $vacation_array[] = $object;
}

// Close the connection to the db
$conn->close();
?>
<html>
<head>
  <title>Vacation Portal</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Vacation Portal</span>
  </nav>
  <div class="container main_container">
  <div class="row align-items-center">
    <div class="col-12">
      <div class="row">
        <div class="col-6">
          <img src="files/online.png" width="12px" class="online_dot"></img>
          <label class="card-title" id="user_title"><?php echo $_SESSION["firstname"]; ?></label>
        </div>
        <div class="col-6">
          <a href="logout.php" class="btn btn-md btn-secondary" id="logout_btn"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <label id="home_lbl"><i class="fa fa-book fa-fw" aria-hidden="true"></i> Your past applications:</label><br>
            </div>
            <div class="col-6">
              <a class="btn btn-md btn-success" href="application_form.php" id="new_req_btn">Submit Request</a>
            </div>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Date submitted</th>
                <th scope="col">Dates requested</th>
                <th scope="col">Days requested</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 0;
              foreach (array_reverse($vacation_array) as $app) {
                $i++;
                $datediff = strtotime( $app->date_from ) - strtotime( $app->date_to );
                $days = round($datediff / (60 * 60 * 24))*(-1);
                echo "<tr>";
                  echo "<td>". $i ."</td>";
                  echo "<td>". $app->date_submitted ."</td>";
                  echo "<td>". $app->date_from ." / ". $app->date_to ."</td>";
                  echo "<td>". $days ."</td>";
                  echo "<td>". $app->req_status . "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
