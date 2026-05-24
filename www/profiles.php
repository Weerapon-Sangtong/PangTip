<?php
    require 'req/navbar.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
    if(isset($_SESSION['user_login'])){
        $user_id = $_SESSION['user_login'];
    } else if(isset($_SESSION['admin_login'])){
        $user_id = $_SESSION['admin_login'];
    }
        $stmt = $conn->query("SELECT * FROM users WHERE user_id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

<div class="container mt-4 card w-75">
<div class="container mt-4">
    <table class="table table-bordered w-75">
        <tr>
            <td class="table-info w-25">
                User ID
            </td>
            <td>
                <?php echo $row['user_id'] ?>
            </td>
        </tr>
        <tr>
            <td class="table-info w-25">
                First Name
            </td>
            <td>
                <?php echo $row['firstname'] ?>
            </td>
        </tr>
        <tr>
            <td class="table-info">
                Last Name
            </td>
            <td>
                <?php echo $row['lastname'] ?>
            </td>
        </tr>
        <tr>
            <td class="table-info">
                E-mail
            </td>
            <td>
                <?php echo $row['email'] ?>
            </td>
        </tr>
        <tr>
            <td class="table-info">
                Account Created
            </td>
            <td>
                <?php echo $row['created_at'] ?>
            </td>
        </tr>
    </table>
</div>
</div>
<div class="container mt-4 w-75">
    <a type="button" class="btn btn-Secondary" href="user.php" role="button">
        Back
    </a>
</div>
</body>
</html>