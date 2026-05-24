<?php
require 'req/navbar.php';
// Check if user_id is set
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Prepare the SELECT query to fetch user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Display the form with user data
        ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <div class="container p-5">
        <form action="userUpdate.php" method="POST">
            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
            
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="urole" class="form-label">User Role</label>
                <input type="text" class="form-control" id="urole" name="urole" value="<?= htmlspecialchars($user['urole']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
        </div>
        <?php
    } else {
        echo "User not found.";
    }
} else {
    echo "No user ID provided.";
}
?>