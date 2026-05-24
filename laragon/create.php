<?php 
    require_once 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php require 'req/navbar.php' ?>
</head> 
<body>
    <div class="container">
    <form action="create_db.php" method="POST">
        <div class="container mt-4">
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>
        </div>
    
        <h3 class="mt-4">สร้างกระทู้</h3>
        <hr>
        <div class="mb-3">
        <label for="category_id" class="form-label">Categories</label>
            <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
                <?php
                    require_once 'config/db.php';  // เรียกไฟล์เชื่อมต่อฐานข้อมูล
                    $stmt = $conn->query("SELECT * FROM categories");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['category_id']}'>{$row['cate_name']}</option>";
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">หัวข้อกระทู้</label>
            <input for="title" type="text" class="form-control" name="title" aria-describedby="tile" placeholder="พิมพ์หัวข้อกระทู้">
        </div>
        <div class="mb-3">
            <label class="form-label">รายละเอียด</label>
            <textarea for="content" type ="text" class="form-control" name="content" aria-describedby="content" rows="3" placeholder="พิมพ์รายละเอียด"></textarea>
        </div>
        <button type="submit" name="post" class="btn btn-secondary">Post</button>
        </form>
    </div>
</body>
</html>