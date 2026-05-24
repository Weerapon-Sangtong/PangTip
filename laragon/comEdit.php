<?php

require 'req/navbar.php';
// ตรวจสอบว่ามีการส่งค่า comment_id หรือไม่
if(isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];
    $post_id = $_GET['post_id'];
    // ดึงข้อมูลคอมเมนต์จากฐานข้อมูล
    $stmt = $conn->prepare("SELECT * FROM comments WHERE comment_id = :comment_id");
    $stmt->bindParam(':comment_id', $comment_id);
    $stmt->execute();
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$comment) {
        echo "Comment not found!";
        exit();
    }
} else {
    echo "No comment ID provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Comment</h2>
        <form action="comUpdate.php" method="POST">
            <input type="hidden" name="post_id" value="<?=$post_id?>">
            <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
            <div class="mb-3">
                <label for="com_detail" class="form-label">Comment Detail</label>
                <input type="text" class="form-control" id="com_detail" name="com_detail" value="<?= htmlspecialchars($comment['com_detail']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>