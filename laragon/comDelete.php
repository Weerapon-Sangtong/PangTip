<?php
// Include your database connection
require 'config/db.php';
session_start();
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the form
    $comment_id = $_POST['comment_id'];
    $post_id = $_POST['post_id'];

    // Prepare the DELETE SQL statement using PDO
    $stmt = $conn->prepare("DELETE FROM comments WHERE comment_id = :comment_id");

    // Bind the user_id parameter to the prepared statement
    $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);

    // Execute the delete query
    if ($stmt->execute()) {
        if ($stmt->rowCount() >= 0) {
            if (isset($_SESSION['admin_login'])) {
                $_SESSION['success'] = "แก้ไขข้อมูลสำเร็จ!";
                // Redirect back to the admin page
                header("Location: admin.php?message=Post updated successfully");
                exit;
            } else if (isset($_SESSION['user_login'])) {
                $_SESSION['success'] = "แก้ไขข้อมูลสำเร็จ!";
                // Redirect to the post detail page
                header("Location: postDetail.php?post_id=" . htmlspecialchars($post_id));
                exit;
            }
        } else {
            header("location: postDetail.php?post_id=". htmlspecialchars($post_id));
        }
    } else {
        echo "Error executing statement.";
    }
}
?>