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

$user_to_be_updated_id = $_GET['user'];

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create the query and get the results from the db
$sql = "SELECT firstname, lastname, email, password, type FROM users WHERE `id`='$user_to_be_updated_id'";
$result = $conn->query($sql);
$users = array();
while($object = mysqli_fetch_object($result)) {
  $users[] = $object;
}

foreach ($users as $user) {
  $firstname = $user->firstname;
  $lastname = $user->lastname;
  $password = $user->password;
  $email = $user->email;
  $type = $user->type;
}

// Close the connection to the db
$conn->close();
?>
<html>
<head>
  <title>User Update</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="container main_container">
  <div class="row align-items-center">
    <div class="col-12">
      <div class="card form_cards">
        <div class="card-body">
          <h5 class="card-title">Update User</h5>
          <p class="card-text form_label">Fill in the form below and save to update an existing user.</p>
          <form action="store_updated_user.php" method="post" id="form">
            <div class="form-group">
              <label for="firstname_input">Firstname</label>
              <input type="text" class="form-control" id="firstname_input" name="firstname_input" value="<?php echo $firstname; ?>" required>
            </div>
            <div class="form-group">
              <label for="lastname_input">Lastname</label>
              <input type="text" class="form-control" id="lastname_input" name="lastname_input" value="<?php echo $lastname; ?>" required>
            </div>
            <div class="form-group">
              <label for="email_input">Email</label>
              <input type="email" class="form-control" id="email_input" name="email_input" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="password_input">Password</label>
                <input type="password" class="form-control" id="password_input" name="password_input" required>
              </div>
              <div class="form-group col-md-6">
                <label for="confirm_password_input">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password_input" name="confirm_password_input" required>
              </div>
            </div>
            <div class="form-group">
              <label for="type_input">Type</label>
              <select class="form-control" id="type_input" name="type_input" required>
                <option <?php if($type=="Employee") {echo 'selected="selected"';} ?>>Employee</option>
                <option <?php if($type=="Admin") {echo 'selected="selected"';} ?>>Admin</option>
              </select>
              <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_to_be_updated_id; ?>">
            </div>
            <button type="submit" class="btn btn-info" id="req_submit_btn">Update</button>
            <a id="cancel_btn" class="btn btn-secondary" href="admin_home.php">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
const form = document.getElementById('form');

form.addEventListener('focusout', (event) => {

  var password = document.getElementById("password_input").value;
  var confirmPassword = document.getElementById("confirm_password_input").value;
  if (password != confirmPassword) {
      document.getElementById("confirm_password_input").style.borderColor = '#f54c40';
      document.getElementById("req_submit_btn").disabled = true;
  } else {
    document.getElementById("confirm_password_input").style.borderColor = '';
    document.getElementById("req_submit_btn").disabled = false;
  }
  return true;
});
</script>
</body>
</html>
