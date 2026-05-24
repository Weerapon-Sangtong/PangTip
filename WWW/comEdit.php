<?php
require 'req/navbar.php';
// Check if user_id is set
if (isset($_GET['comment_id'])) {
    $user_id = $_GET['comment_id'];

    // Prepare the SELECT query to fetch user data
    $stmt = $conn->prepare("SELECT * FROM comments WHERE comment_id = :comment_id");
    $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the user data
    $comments = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($comments) {
        // Display the form with user data
        ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <div class="container p-5">
        <form action="comUpdate.php" method="POST">
            <input type="hidden" name="comment_id" value="<?= $comments['comment_id'] ?>">
            
            <div class="mb-3">
                <label for="firstname" class="form-label">Comment Detail</label>
                <input type="text" class="form-control" id="comment_id" name="comment_id" value="<?= htmlspecialchars($comments['comment_id']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Comment</button>
        </form>
        </div>
        <?php
    } else {
        echo "Comment not found.";
    }
} else {
    echo "No comment ID provided.";
}
?>