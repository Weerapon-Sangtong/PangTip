<?php
    require 'req/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>News And Sports</title>
</head>
<body>
    
<div class="container card mt-4 mb-5">
    <div class="container mt-4">
      <h1>News And Sports</h1>
    </div>
    <hr>
    <div class="row row-cols-1 row-cols-md-2 g-3 mt-2 mb-4">
        <div class="col">
             <h5 class="card-title"><b>กระทู้ทั้งหมด</b></h5>
        </div>
    </div>

    <?php 
        $check_data = $conn->prepare("SELECT users.user_id, users.firstname, posts.post_id, posts.post_title, posts.post_content, posts.post_time, posts.category_id 
                                        FROM users 
                                        INNER JOIN posts ON users.user_id = posts.user_id 
                                        WHERE posts.category_id = :category_id");
        $cat = 1;
        $check_data->bindParam(":category_id", $cat );
        $check_data->execute();
    ?>
        
    <?php while($row = $check_data->fetch(PDO::FETCH_ASSOC)): ?>
            <div style="border: 1px solid #ddd; padding: 7px; margin-bottom: 15px; border-radius: 5px; background-color: #f9f9f9;">
            <a href="postDetail.php?post_id=<?=$row['post_id']?>" class="text-decoration-none text-dark" >
            <div style="margin-top: 10px; font-size: 28px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                <b><?= htmlspecialchars($row['post_title']) ?></b></div>
            <div class="mt-3 mb-3" style="font-size: 16px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            <?= htmlspecialchars($row['post_content']) ?></div><hr>
            <div class="mt-2 fdate" style="font-size: 16px;">Posted by <b><?= htmlspecialchars($row['firstname']) ?></b>  / Posted on <?= htmlspecialchars($row['post_time']) ?>
            </div></a>
            </div>
    <?php endwhile; ?>
</body>
</html>