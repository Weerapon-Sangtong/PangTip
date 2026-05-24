<?php
// Include database connection
require 'req/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $post_id = $_POST['post_id'];
    $category_id = $_POST['category_id'];
    $user_id = $_POST['user_id'];
    $post_title = $_POST['post_title'];
    $post_content = $_POST['post_content'];
    

    // Prepare the UPDATE SQL statement
    $stmt = $conn->prepare("UPDATE posts SET category_id = :category_id, user_id = :user_id, post_title = :post_title, post_content = :post_content WHERE post_id = :post_id");

    // Bind parameters
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_STR);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_STR);
    $stmt->bindParam(':post_title', $post_title, PDO::PARAM_STR);
    $stmt->bindParam(':post_content', $post_content, PDO::PARAM_STR);
    // Execute the query
    if ($stmt->execute()) {
        // Redirect back to the user list or display success message
        header("Location: admin.php?message= Post updated successfully");
        exit;
    } else {
        echo "Error updating post.";
    }
}
?>
