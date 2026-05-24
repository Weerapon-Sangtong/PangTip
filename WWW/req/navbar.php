<?php
    require 'config/check.php';
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .my-svg {
            width: 16px;  /* Change the size using CSS */
            height: 16px;
        }
    </style>
<nav id="navbar-scr" class="navbar navbar-expand-md navbar-dark bg-dark p-3">   
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
            <a class="nav-link" href="logout.php">Logout <svg class="my-svg" fill="#ebebeb" xmlns="http://www.w3.org/2000/svg" height="10" width="10" viewBox="0 0 512 512"><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg></a>
            </li>
        </ul>
    </div>
</nav>