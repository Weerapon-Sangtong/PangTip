<?php 
    session_start();
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
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="main.php" class="navbar-brand ms-4">PangTip</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar6">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar6">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="profiles.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="create.php">Create Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="categories.php">Categories</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto position-absolute end-0 me-4">
            <li class="nav-item">
                <a class="nav-link" href="signin.php">Sign In</a>
            </li>
            <li class="nav-item">
                <p class="nav-link">/</p>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sign Up</a>
            </li>
        </ul>
    </div>
</nav>
</body>
</html>