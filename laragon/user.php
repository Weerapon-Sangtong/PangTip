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
    <link rel="stylesheet" href="css/style.css">
    <style>
       .truncate-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }
        .text-center{
            display: flex;
            justify-content: center; /* จัดกลางแนวนอน */
            align-items: center;    /* จัดกลางแนวตั้ง */
            height: 100vh;
        }
    </style>

</head>
<body>
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
<?php
    require 'req/navbar.php';
?>
    <div class="container p-3">
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
    <div class="container card p-3 overflow-scroll mb-5" style="height: 50rem;">
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
                    <div class="card-body overflow-auto">
                        <p class="card-text"><?=nl2br(htmlspecialchars($row['post_content']))?></p>
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