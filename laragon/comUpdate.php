<?php
// Include database connection
require 'req/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $comment_id = $_POST['comment_id'];
    $com_detail = $_POST['com_detail'];
    $post_id = $_POST['post_id'];

    // Prepare the UPDATE SQL statement
    $stmt = $conn->prepare("UPDATE comments SET com_detail = :com_detail WHERE comment_id = :comment_id");

    // Bind parameters
    $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $stmt->bindParam(':com_detail', $com_detail, PDO::PARAM_STR);


    // Execute the query
    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = "แก้ไขข้อมูลสำเร็จ!";
        } else {
            $_SESSION['error'] = "No changes were made.";
        }
        // Redirect to the post detail page
        header("Location: postDetail.php?post_id=" . htmlspecialchars($post_id));
        exit;
    } else {
        // Display error
        echo "Error executing statement: " . implode(", ", $stmt->errorInfo());
    }
}
?>
