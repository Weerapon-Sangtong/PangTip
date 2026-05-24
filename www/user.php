<?php
    require_once 'config/db.php'
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พังติป</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php require 'req/navbar.php'; ?>
    <div class="container">
        <?php 
        if(isset($_SESSION['user_login'])){
            $users_id = $_SESSION['user_login'];
        } else if(isset($_SESSION['admin_login'])){
            $users_id = $_SESSION['admin_login'];
        }
            $stmt = $conn->query("SELECT * FROM users WHERE user_id = $users_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <h3 class="mt-4">Welcome<?php if(isset($_SESSION['admin_login'])){echo ' Admin';} ?>, <?php echo $row['firstname'] ?></h3>
    </div>  
</body>
</html>