<?php
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
?>
<html>
<head>
  <title>New Application Request</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Vacation Portal</span>
  </nav>
  <div class="container main_container">
  <div class="row align-items-center">
    <div class="col-12">
      <div class="card form_cards">
        <div class="card-body">
          <h5 class="card-title">New Application</h5>
          <p class="card-text form_label">Fill in the form below to submit a new vacation request.</p>
          <form action="store_request.php" method="post" id="form">
            <div class="form-group">
              <label for="date_from_input">Date from</label>
              <input type="date" class="form-control" id="date_from_input" name="date_from_input" oninput="dateValidation()" required>
            </div>
            <div class="form-group">
              <label for="date_to_input">Date to</label>
              <input type="date" class="form-control" id="date_to_input" name="date_to_input" oninput="dateValidation()" required>
            </div>
            <div class="form-group">
              <label for="reason_input">Reason</label>
              <textarea class="form-control" id="reason_input" name="reason_input" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-info" id="req_submit_btn">Submit</button>
            <a id="cancel_btn" class="btn btn-secondary" href="home.php">Cancel</a>
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
// Date input Validation
function dateValidation() {
  var date_from = document.getElementById("date_from_input").valueAsDate;
  var date_to = document.getElementById("date_to_input").valueAsDate;
  date_from = new Date(date_from);
  date_to = new Date(date_to);
  var today = new Date();
  if (date_from < today && date_to < today) {
    document.getElementById("req_submit_btn").disabled = true;
    document.getElementById("date_from_input").style.borderColor = '#f54c40';
    document.getElementById("date_to_input").style.borderColor = '#f54c40';
  }
  if(date_from >= date_to) {
    document.getElementById("req_submit_btn").disabled = true;
    document.getElementById("date_from_input").style.borderColor = '#f54c40';
    document.getElementById("date_to_input").style.borderColor = '#f54c40';
  }
  if((date_from >= today && date_to >= today) && date_from < date_to) {
    document.getElementById("req_submit_btn").disabled = false;
    document.getElementById("date_from_input").style.borderColor = '';
    document.getElementById("date_to_input").style.borderColor = '';
  }
}
</script>
</body>
</html>
