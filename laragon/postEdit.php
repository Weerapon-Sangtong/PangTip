<?php
require 'req/navbar.php';

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    // Prepare the SELECT query to fetch user data
    $stmt = $conn->prepare("SELECT categories.cate_name, categories.category_id, posts.post_id, posts.post_title, posts.post_content, posts.user_id, posts.post_time FROM categories INNER JOIN posts ON posts.category_id = categories.category_id WHERE posts.post_id = :post_id");
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the user data
    $posts = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($posts) {
        // Display the form with user data
        ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="container p-3">
        <form action="postUpdate.php" method="POST">
            <input type="hidden" name="user_id" value="<?= $posts['user_id'] ?>">
                <input type="hidden" name="post_id" value="<?= $posts['post_id'] ?>">
                <div class="mb-3 container">
                    <label for="post_title" class="form-label"><h3>Post Title</h3></label>
                    <input type="text" class="form-control" id="post_title" name="post_title" value="<?= htmlspecialchars($posts['post_title']) ?>" required>
                </div>
                <div class="mb-3 container">
                    <label for="post_content" class="form-label"><h3>Post Details</h3></label>
                    <textarea type="text" class="form-control" rows="5" id="post_content" name="post_content" required><?= htmlspecialchars($posts['post_content']) ?></textarea >
                </div>
                <div class="mb-3 container"><h3>Post Category</h3></label>
                    <select class="form-control mt-2" id="category_id" name="category_id" required>
                    <option value="<?= $posts['category_id'] ?>" <?= $posts['category_id'] == $posts['category_id'] ? 'selected' : '' ?>><?=    $posts['cate_name'] ?></option>
                        <?php
                        $cate = $conn->query("SELECT * FROM categories"); 
                        $cate->execute();
                        while ($posts = $cate->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$posts['category_id']}'>{$posts['cate_name']}</option>";
                        } ?>
                    </select>
                </div>
                    <a href="postDetail.php?post_id=<?=$post_id?>" role="button" class="btn btn-secondary">Close</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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