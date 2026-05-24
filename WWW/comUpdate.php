<?php
// Include database connection
require 'req/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $comment_id = $_POST['comment_id'];
    $com_detail = $_POST['com_detail'];
    

    // Prepare the UPDATE SQL statement
    $stmt = $conn->prepare("UPDATE comments SET com_detail = :com_detail WHERE comment_id = :comment_id");

    // Bind parameters
    $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $stmt->bindParam(':com_detail', $com_detail, PDO::PARAM_STR);


    // Execute the query
    if ($stmt->execute()) {
        // Redirect back to the user list or display success message
        header("Location: admin.php?message=Comment updated successfully");
        exit;
    } else {
        echo "Error updating Comment.";
    }
}
?>
