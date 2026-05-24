<?php
// Include your database connection
require 'config/db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the form
    $comment_id = $_POST['comment_id'];

    // Prepare the DELETE SQL statement using PDO
    $stmt = $conn->prepare("DELETE FROM comments WHERE comment_id = :comment_id");

    // Bind the user_id parameter to the prepared statement
    $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);

    // Execute the delete query
    if ($stmt->execute()) {
        // If delete is successful, redirect to the page with a success message (or refresh)
        header("Location: admin.php?message=Comment deleted successfully");
        exit;
    } else {
        // If the delete fails, handle the error
        echo "Error deleting Comment.";
    }
}
?>