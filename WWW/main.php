<?php 
    session_start();
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
<nav class="navbar navbar-expand-md navbar-dark bg-dark p-3">
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
<div class="container card p-3 overflow-scroll mb-5 mt-4" style="height: 50rem;">
    <h2>โพสต์ล่าสุด</h2>
    <div class="row">
    <?php 
        $stmt = $conn->prepare("SELECT * FROM users INNER JOIN posts ON posts.user_id = users.user_id INNER JOIN categories ON posts.category_id = categories.category_id ORDER BY posts.post_time DESC;");
        $stmt->execute();
    ?>
    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
        <div class="col-sm-4 p-1">
        <a href="postDetail.php?post_id=<?=$row['post_id']?>" class="text-decoration-none text-dark"><div class="card hfx" style="width: 24rem; height: 24rem;">
                <div class="container mt-3"><?= $row['cate_name'] ?></div>
                <hr>
                <div class="container mt-3"><h5 class="card-title"><?=$row['post_title']?></h5></div>
                <div class="card-body overflow-hidden overflow-auto">
                    <p class="card-text"><?=$row['post_content']?></p>
                </div>
                <hr>
                <div class="contain mb-1 ms-3">Posted by <?= $row['firstname']?><p class="fdate"><?=$row['post_time'] ?></p></div>
            </div></a>
        </div>
    <?php endwhile; ?>
    </div>
</div>
</body>
</html>