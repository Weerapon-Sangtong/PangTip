<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ล็อกอิน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="main.php" class="navbar-brand ms-4">PangTip</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar6">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
    <div class="container">
      <h3 class ="mt-4">เข้าสู่ระบบ</h3>
      <hr>
      <form action="signin_db.php" method="post">
      <?php if(isset($_SESSION['error'])) { ?>
          <div class="alert alert-danger">
            <?php
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            ?>
            </div>
          <?php } ?>
          <?php if(isset($_SESSION['success'])) { ?>
          <div class="alert alert-success">
            <?php
              echo $_SESSION['success'];
              unset($_SESSION['success']);
              header("location: user.php");
            ?>
            </div>
          <?php } ?>
  <div class="form-floating mb-3">
    <input type="email" class="form-control" name="email" id="floatingInput" aria-describedby="email" placeholder="">
    <label for="floatingInput">E-mail Address</label>
  </div>
  <div class="form-floating mb-3">
    <input type="password" class="form-control" name="password" id="floatingInput" aria-describedby="password" placeholder="">
    <label for="password">Password</label>
    <div id="emailHelp" class="form-text mt-2">Don't share your email or password.</div>
  </div>
  <button type="submit" name="signin" class="btn btn-secondary">Sign In</button>
</form>
<hr>
<p>หากยังไม่เป็นสมาชิก<a href="index.php" class="text-secondary">คลิกที่นี้</a> เพื่อสมัครสมาชิก</p>
    </div>
</body>
</html>