<?php
session_start();
$user = $_SESSION["type"];
?>
<html>
<head>
  <title>Error</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Vacation Portal</span>
  </nav>
  <div class="container main_container" id="login_container">
  <div class="row align-items-center">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Error 404!</h5>
          <p class="card-text">The Page you are looking for does not exist or an other error occurred.</p>
          <?php
            if($user=="Admin") {
              echo '<a href="/admin_home.php" class="btn btn-md btn-info">Go to Home page</a>';
            } elseif ($user=="Employee") {
              echo '<a href="/home.php" class="btn btn-md btn-info">Go to Home page</a>';
            }
          ?>
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
