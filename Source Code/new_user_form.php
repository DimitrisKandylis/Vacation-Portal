<?php
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
?>
<html>
<head>
  <title>New User Creation</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="container main_container">
  <div class="row align-items-center">
    <div class="col-12">
      <div class="card form_cards">
        <div class="card-body">
          <h5 class="card-title">Create New User</h5>
          <p class="card-text form_label">Fill in the form below to create a new user.</p>
          <form action="store_user.php" method="post" id="form">
            <div class="form-group">
              <label for="firstname_input">Firstname</label>
              <input type="text" class="form-control" id="firstname_input" name="firstname_input" placeholder="John" required>
            </div>
            <div class="form-group">
              <label for="lastname_input">Lastname</label>
              <input type="text" class="form-control" id="lastname_input" name="lastname_input" placeholder="Doe" required>
            </div>
            <div class="form-group">
              <label for="email_input">Email</label>
              <input type="email" class="form-control" id="email_input" name="email_input" placeholder="example@email.com" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="password_input">Password</label>
                <input type="password" class="form-control" id="password_input" name="password_input" placeholder="Sample Password" required>
              </div>
              <div class="form-group col-md-6">
                <label for="confirm_password_input">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password_input" name="confirm_password_input" required>
              </div>
            </div>
            <div class="form-group">
              <label for="type_input">Type</label>
              <select class="form-control" id="type_input" name="type_input" required>
                <option>Employee</option>
                <option>Admin</option>
              </select>
            </div>
            <button type="submit" class="btn btn-info" id="req_submit_btn">Create</button>
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
// Password Confir Validation
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
