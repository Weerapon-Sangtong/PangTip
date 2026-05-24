<?php require 'req/navbar.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container"><h1>Admin Menu</h1></div>
<hr>
<div class="container mt-4">
<div class="w-100">
    <div class="wrapper">
        <nav class="nav nav-tabs list mt-2" id="myTab" role="tablist">
            <a class="nav-item nav-link active" data-toggle="tab" href="#users" role="tab" aria-controls="public" aria-expanded="true">Users</a>
            <a class="nav-item nav-link" href="#posts" role="tab" data-toggle="tab">Posts</a>
            <a class="nav-item nav-link" href="#comments" role="tab" data-toggle="tab">Comments</a>
        </nav>
    </div>
    <div class="tab-content p-3" id="myTabContent">
        <div role="tabpanel" class="tab-pane fade active show mt-2" id="users" aria-labelledby="public-tab" aria-expanded="true">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 ">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">
                                            </th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">email</th>
                                            <th scope="col">Account Created</th>
                                            <th scope="col">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $stmt = $conn->prepare("SELECT * FROM users");
                                        $stmt->execute();
                                    ?>
                                    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                            <tr>
                                                <th scope="row"></th>
                                                <td><?= $row['user_id'] ?></td>
                                                <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                                                <td><?= $row['urole'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                <td><?= $row['created_at'] ?></td>
                                                <td>
                                                <button type="button" class="btn btn-success btn-sm px-2" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['user_id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm px-2" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row['user_id'] ?>">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                                <!--Delete-->
                                                <div class="modal fade" id="deleteModal<?= $row['user_id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $row['user_id'] ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel<?= $row['user_id'] ?>">Confirm Delete</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete <?= $row['firstname'] . ' ' . $row['lastname'] ?>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <!-- Delete form -->
                                                                <form action="userDelete.php" method="POST">
                                                                    <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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
                                                                        <label for="urole" class="form-label">Role</label>
                                                                        <label for="urole" class="form-label">User Role</label>
                                                                        <select class="form-control" id="urole" name="urole" required>
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
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="tab-pane fade mt-2" id="posts" role="tabpanel" aria-labelledby="group-dropdown2-tab" aria-expanded="false">
        <div role="tabpanel" class="tab-pane fade active show mt-2" id="posts" aria-labelledby="public-tab" aria-expanded="true">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 ">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">
                                            </th>
                                            <th scope="col">Post ID</th>
                                            <th scope="col">Categories</th>
                                            <th scope="col">Head Post</th>
                                            <th scope="col">Post Created</th>
                                            <th scope="col">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        $stmt = $conn->prepare("SELECT posts.*, categories.cate_name FROM posts JOIN categories ON posts.category_id = categories.category_id");
                                        $stmt->execute();
                                    ?>
                                    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                            <tr>
                                                <th scope="row"></th>
                                                <td><?= $row['post_id'] ?></td>
                                                <td><?= $row['cate_name'] ?></td>
                                                <td><?= $row['post_title'] ?></td>
                                                <td><?= $row['post_time'] ?></td>


                                                <td>
                                                <button type="button" class="btn btn-success btn-sm px-2" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['post_id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm px-2" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row['post_id'] ?>">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                                <!--Delete-->
                                                <div class="modal fade" id="deleteModal<?= $row['post_id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $row['post_id'] ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel<?= $row['post_id'] ?>">Confirm Delete</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete <?= $row['post_id']?>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <!-- Delete form -->
                                                                <form action="postDelete.php" method="POST">
                                                                    <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>">
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Edit -->
                                                <div class="modal fade" id="editModal<?= $row['post_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['post_id'] ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel<?= $row['post_id'] ?>">Edit Post</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Edit form inside modal -->
                                                                <form action="postUpdate.php" method="POST">
                                                                    <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>">
                                                                    <div class="mb-3">
                                                                        <label for="post_id" class="form-label">Post ID</label>
                                                                        <input type="text" class="form-control" id="post_id" name="post_id" value="<?= htmlspecialchars($row['post_id']) ?>" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="category_id" class="form-label">Categories</label>
                                                                        <input type="text" class="form-control" id="category_id" name="category_id" value="<?= htmlspecialchars($row['category_id']) ?>" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="user_id" class="form-label">User ID</label>
                                                                        <input type="text" class="form-control" id="user_id" name="user_id" value="<?= htmlspecialchars($row['user_id']) ?>" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="post_title" class="form-label">Post Title</label>
                                                                        <input type="text" class="form-control" id="post_title" name="post_title" value="<?= htmlspecialchars($row['post_title']) ?>" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="post_content" class="form-label">Post Content</label>
                                                                        <input type="text" class="form-control" id="post_content" name="post_content" value="<?= htmlspecialchars($row['post_content']) ?>" required>
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
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="tab-pane fade mt-2" id="comments" role="tabpanel" aria-labelledby="group-dropdown2-tab" aria-expanded="false">
            3
        </div>
    </div>
</div>
</div>

</body>
</html>