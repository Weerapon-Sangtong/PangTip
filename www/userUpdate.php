<?php
// Include database connection
require 'req/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $urole = $_POST['urole'];

    // Prepare the UPDATE SQL statement
    $stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, urole = :urole WHERE user_id = :user_id");

    // Bind parameters
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':urole', $urole, PDO::PARAM_STR);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect back to the user list or display success message
        header("Location: admin.php?message=User updated successfully");
        exit;
    } else {
        echo "Error updating user.";
    }
}
?>
