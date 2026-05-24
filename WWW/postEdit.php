<?php
require 'req/navbar.php';
// Check if user_id is set
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Prepare the SELECT query to fetch user data
    $stmt = $conn->prepare("SELECT * FROM posts WHERE post_id = :post_id");
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the user data
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($posts) {
        // Display the form with user data
        ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <div class="container p-5">
        <form action="postUpdate.php" method="POST">
            <input type="hidden" name="post_id" value="<?= $user['post_id'] ?>">
            
            <!-- <div class="mb-3">
                <label for="firstname" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="post_title" name="post_title" value="<?= htmlspecialchars($posts['post_title']) ?>" required>
            </div> -->

            <div class="mb-3">
                <label for="lastname" class="form-label">category ID</label>
                <input type="text" class="form-control" id="category_id" name="category_id" value="<?= htmlspecialchars($posts['category_id']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="urole" class="form-label">Post Content</label>
                <input type="text" class="form-control" id="post_content" name="post_content" value="<?= htmlspecialchars($posts['post_content']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
        </div>
        <?php
    } else {
        echo "Post not found.";
    }
} else {
    echo "No Post ID provided.";
}
?>