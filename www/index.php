<?php
  session_start();
  require_once 'config/db.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิค</title>
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
      <h3 class ="mt-4">สมัครสมาชิก</h3>
      <hr>
      <form action="signup_db.php" method="post">

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
            ?>
            </div>
          <?php } ?>
          <?php if(isset($_SESSION['warning'])) { ?>
          <div class="alert alert-warning">
            <?php
              echo $_SESSION['warning'];
              unset($_SESSION['warning']);
            ?>
            </div>
          <?php } ?>

          <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" name="firstname" aria-describedby="firstname" placeholder="ชื่อจริง">
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lastname" aria-describedby="lastname" placeholder="นามสกุล">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" aria-describedby="email" placeholder="กรอกอีเมล">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="กรอกรหัสผ่าน">
            <div class="col-auto">
          </div>
          <div class="mt-2"><span id="passwordHelpInline" class="form-text">
              รหัสผ่านต้องมีความยาวอย่างน้อย 5 - 20 ตัวอักษร
          </span>
        </div>
         </div>  
          <div class="mb-3">
            <label for="confirm password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="c_password" placeholder="กรอกรหัสผ่านอีกครั้ง">
          </div>
          <button type="submit" name="signup" class="btn btn-secondary">Sign Up</button>
      </form>
      <hr>
     
      <p>หากเป็นสมาชิกอยู่แล้ว<a href="signin.php" class="text-secondary">เข้าสู่ระบบ</a></p>
    </div>
</body>
</html>