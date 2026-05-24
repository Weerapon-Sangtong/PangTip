<?php
    require 'config/check.php';
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="user.php" class="navbar-brand ms-4">PangTip</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar6">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar6">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="profiles.php">Profile</a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" href="create.php">Create Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="categories.php">Categories</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto position-absolute end-0 me-4">
            <?php 
                if(isset($_SESSION['admin_login'])){
                    echo '<li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                            </li>';
                }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
