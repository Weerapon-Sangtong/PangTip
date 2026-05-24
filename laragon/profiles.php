<?php
    require 'req/navbar.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
    if(isset($_SESSION['user_login'])){
        $user_id = $_SESSION['user_login'];
    } else if(isset($_SESSION['admin_login'])){
        $user_id = $_SESSION['admin_login'];
    }
        $stmt = $conn->query("SELECT * FROM users WHERE user_id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

<div class="mt-4 ms-4 me-4">
<?php if(isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger">
    <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    ?>
    </div>
    <?php } ?>
    <?php if(isset($_SESSION['success'])) { ?>
    <div class="alert alert-success">
    <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    ?>
    </div>
<?php } ?>
</div>

<div class="container mt-4">
    
</div>

<div class="container mt-4"><h1><a type="button" class="btn btn-Secondary" href="user.php" role="button">
    <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M10.78 19.03a.75.75 0 0 1-1.06 0l-6.25-6.25a.75.75 0 0 1 0-1.06l6.25-6.25a.749.749 0 0 1 1.275.326.749.749 0 0 1-.215.734L5.81 11.5h14.44a.75.75 0 0 1 0 1.5H5.81l4.97 4.97a.75.75 0 0 1 0 1.06Z"></path></svg> Back
    </a> Profile</h1></div>
<div class="container mt-4 card w-75">
<div class="container mt-4">
    <table class="table table-bordered w-75">
        <tr>
            <td class="table-info w-25">
                User ID
            </td>
            <td>
                <?php echo $row['user_id'] ?>
            </td>
        </tr>
        <tr>
            <td class="table-info w-25">
                First Name
            </td>
            <td>
                <?php echo $row['firstname'] ?>
            </td>
        </tr>
        <tr>
            <td class="table-info">
                Last Name
            </td>
            <td>
                <?php echo $row['lastname'] ?>
            </td>
        </tr>
        <tr>
            <td class="table-info">
                Role
            </td>
            <td>
                <?php echo $row['urole'] ?>
            </td>
        </tr>
        <tr>
            <td class="table-info">
                E-mail
            </td>
            <td>
                <?php echo $row['email'] ?>
            </td>
        </tr>
        <tr>
            <td class="table-info">
                Account Created
            </td>
            <td>
                <?php echo $row['created_at'] ?>
            </td>
        </tr>
    </table>
    <div class="mb-4">
        <td>
        <button type="button" class="btn btn-success btn-sm px-2" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['user_id'] ?>">
            <i class="fa-solid fa-pen-to-square"> แก้ไขโปรไฟล์</i>
        </button>
        <!-- Edit -->
        <div class="modal fade" id="editModal<?= $row['user_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['user_id'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel<?= $row['user_id'] ?>">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Edit form inside modal -->
                        <form action="userUpdate.php" method="POST">
                            <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= htmlspecialchars($row['firstname']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= htmlspecialchars($row['lastname']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="urole" value="<?php echo $row['urole']; ?>">
                                <label for="urole" class="form-label">User Role</label>
                                <select class="form-control" id="urole" name="urole" disabled>
                                    <option value="user" <?= $row['urole'] == 'user' ? 'selected' : '' ?>>user</option>
                                    <option value="admin" <?= $row['urole'] == 'admin' ? 'selected' : '' ?>>admin</option>
                                </select>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </td>
    </div>
</div>
</div>
<div class="container mt-4"><h1>Post(s)</h1></div>
<div class="container card mt-4 p-3 overflow-scroll">
    <div class="card-body row" style="height: 410px;">
        <?php
            $stmt = $conn->prepare("SELECT * FROM users INNER JOIN posts ON posts.user_id = users.user_id INNER JOIN categories ON posts.category_id = categories.category_id WHERE posts.user_id = $user_id  ORDER BY posts.post_time DESC;");
            $stmt->execute();
        ?>
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
            <div class="card-body p-1" style="min-width: 25rem; max-width: 25rem;">
            <a href="postDetail.php?post_id=<?=$row['post_id']?>" class="text-decoration-none text-dark"><div class="card hfx" style="width: 24rem; height: 24rem;">
                    <div class="container mt-3"><?= $row['cate_name'] ?>    </div>
                    <hr>
                    <div class="container mt-1 mb-1"><h5 class="card-title"><?=$row['post_title']?></h5></div>
                    <div class="card-body overflow-auto">
                        <div class="card-text"><?= $row['post_content'] ?></div>
                    </div>
                    <hr>
                    <div class="contain mb-1 ms-3">Posted by <?= $row['firstname']?><p class="fdate"><?=$row['post_time'] ?></p></div>
                </div></a>
            </div>
        <?php endwhile; ?>
        </div>
    </div>
<div class="container mt-4 mb-3"><h1>Comment(s)</h1></div>
<div class="container card mb-5 p-3 overflow-scroll">
    <div class="card-body row" style="height: 410px;">
    <?php
            $stmt = $conn->prepare("SELECT * FROM comments INNER JOIN posts ON posts.post_id = comments.post_id WHERE comments.user_id = $user_id  ORDER BY comments.com_date DESC;");
            $stmt->execute();
        ?>
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
            <div class="card-body col-sm-4 p-1" style="min-width: 26rem; max-width: 28rem;">
            <a href="postDetail.php?post_id=<?=$row['post_id']?>" class="text-decoration-none text-dark"><div class="card hfx" style="width: 24rem; height: 12rem;">
                    <div class="container mt-3"><h5 class="card-title"><?= $row['post_title'] ?></h5></div>
                    <hr>
                    <div class="card-body overflow-hidden overflow-auto">
                        <h6><p class="card-text"><?=$row['com_detail']?></p></h6>
                    </div>
                    <hr>
                    <div class="contain mb-1 ms-3"><p class="fdate"><?=$row['com_date'] ?></p></div>
                </div></a>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>