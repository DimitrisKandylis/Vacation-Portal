<?php
include("config.php");
session_start();

// Check if sesion exists. Else go to Login page
if($_SESSION["firstname"]==null) {
  header("Location: /");
  exit;
}

// Employee users are not allowed to enter this page
if($_SESSION["type"]=="Employee") {
  header("Location: /error_pages/error_404.php");
  exit;
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create the query and get the results from the db
$sql = "SELECT id, firstname, lastname, email, type FROM users";
$result = $conn->query($sql);
$users = array();
while($object = mysqli_fetch_object($result)) {
  $users[] = $object;
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
              <label id="home_lbl"><i class="fa fa-users" aria-hidden="true"></i> List of Portal Users:</label><br>
            </div>
            <div class="col-6">
              <a class="btn btn-md btn-success" href="new_user_form.php" id="new_req_btn">Create new User</a>
            </div>
          </div>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 0;
              foreach ($users as $user) {
                $i++;
                echo '<tr class="clickable-row" style="cursor: pointer;" data-href="update_user_form.php?user='. $user->id .'">';
                  echo "<td>". $i ."</td>";
                  echo "<td>". $user->firstname ."</td>";
                  echo "<td>". $user->lastname ."</td>";
                  echo "<td>". $user->email ."</td>";
                  echo "<td>". $user->type . "</td>";
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
<script>
// Clickable Rows Csript
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
})
</script>
</body>
</html>
