<?php
// Include your database connection
require 'config/check.php'; 

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the form
    $post_id = $_POST['post_id'];

    // Prepare the DELETE SQL statement using PDO
    $stmt = $conn->prepare("DELETE FROM comments WHERE post_id = :post_id;
                            DELETE FROM posts WHERE post_id = :post_id;");

    // Bind the user_id parameter to the prepared statement
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);

    // Execute the delete query 
    if ($stmt->execute()){
        if ($_SESSION['admin_login']) {
            echo 'suck';
            $_SESSION['success'] = "แก้ไขข้อมูลสำเร็จ!";
            // Redirect back to the user list or display success message
            header("Location: admin.php");
            // exit;
        } else if ($_SESSION['user_login']){
            $_SESSION['success'] = "แก้ไขข้อมูลสำเร็จ!";
            header("location: user.php");
        }
    } else {
        echo $e->getMessage();
    }
}
?>