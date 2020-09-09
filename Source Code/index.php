<?php

?>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Vacation Portal</span>
  </nav>
  <div class="container main_container" id="login_container">
  <div class="row align-items-center">
    <div class="col-12">
      <div class="card" id="login_card">
        <div class="card-body">
          <img src="files/group.png" id="login_icon"></img>
          <h4 class="card-title">Login</h4>
          <p class="card-text">Fill in your credentials to login.</p>
          <form action="welcome.php" method="post">
            <div class="form-group">
              <input type="email" class="form-control" id="email_input_login" name="email_input_login" aria-describedby="emailHelp" placeholder="Email address" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="password_input_login" name="password_input_login" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-info btn-block" id="login_btn">Login</button>
          </form>
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
