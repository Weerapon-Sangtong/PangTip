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
    <link rel="stylesheet" href="css/style.css">
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
<div class="container mt-4">
    <a type="button" class="btn btn-Secondary" href="user.php" role="button">
    <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M10.78 19.03a.75.75 0 0 1-1.06 0l-6.25-6.25a.75.75 0 0 1 0-1.06l6.25-6.25a.749.749 0 0 1 1.275.326.749.749 0 0 1-.215.734L5.81 11.5h14.44a.75.75 0 0 1 0 1.5H5.81l4.97 4.97a.75.75 0 0 1 0 1.06Z"></path></svg> Back
    </a>
</div>
<div class="container mt-4"><h1>Profile</h1></div>
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
                Role
            </td>
            <td>
                <?php echo $row['urole'] ?>
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
<div class="container mt-4"><h1>Post(s)</h1></div>
<div class="container card mt-4 p-3 overflow-scroll">
    <div class="card-body row" style="height: 410px;">
        <?php
            $stmt = $conn->prepare("SELECT * FROM users INNER JOIN posts ON posts.user_id = users.user_id INNER JOIN categories ON posts.category_id = categories.category_id WHERE posts.user_id = $user_id  ORDER BY posts.post_time DESC;");
            $stmt->execute();
        ?>
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
            <div class="card-body col-sm-4 p-1">
            <a href="postDetail.php?post_id=<?=$row['post_id']?>" class="text-decoration-none text-dark"><div class="card hfx" style="width: 24rem; height: 24rem;">
                    <div class="container mt-3"><?= $row['cate_name'] ?></div>
                    <hr>
                    <div class="container mt-1 mb-1"><h5 class="card-title"><?=$row['post_title']?></h5></div>
                    <div class="card-body overflow-auto">
                        <div class="card-text"><?= $row['post_content'] ?></div>
                    </div>
                    <hr>
                    <div class="contain mb-1 ms-3">Posted by <?= $row['firstname']?><p class="fdate"><?=$row['post_time'] ?></p></div>
                </div></a>
            </div>
        <?php endwhile; ?>
        </div>
    </div>
<div class="container mt-4 mb-3"><h1>Comment(s)</h1></div>
<div class="container card mb-5 p-3 overflow-scroll">
    <div class="card-body row" style="height: 410px;">
    <?php
            $stmt = $conn->prepare("SELECT * FROM comments INNER JOIN posts ON posts.post_id = comments.post_id WHERE comments.user_id = $user_id  ORDER BY comments.com_date DESC;");
            $stmt->execute();
        ?>
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
            <div class="card-body col-sm-4 p-1">
            <a href="postDetail.php?post_id=<?=$row['post_id']?>" class="text-decoration-none text-dark"><div class="card hfx" style="width: 24rem; height: 12rem;">
                    <div class="container mt-3"><h5 class="card-title"><?= $row['post_title'] ?></h5></div>
                    <hr>
                    <div class="card-body overflow-hidden overflow-auto">
                        <h6><p class="card-text"><?=$row['com_detail']?></p></h6>
                    </div>
                    <hr>
                    <div class="contain mb-1 ms-3"><p class="fdate"><?=$row['com_date'] ?></p></div>
                </div></a>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>