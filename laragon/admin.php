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
<?php if(!isset($_SESSION['admin_login'])){ echo $_SESSION['error'] = 'คุณไม่มีสิทธิ์เข้าถึง'; sleep(5); header('location: user.php'); } ?>

<script>
    function confirmDelete(comment_id) {
        // แสดงการยืนยันการลบ
        if (confirm("Are you sure you want to delete this comment?")) {
            // ถ้ายืนยันการลบ ให้ส่งฟอร์ม
            document.getElementById('deleteForm' + comment_id).submit();
        }
    }
</script>

</head>
<body>
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
    <div class="container mt-4"><h1>Admin Menu</h1></div>
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
    </div>

    <style>
       .truncate-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }
    </style>

    <div class="tab-content p-3 white" id="myTabContent">
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
                                                <th scope="col"></th>
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
                                                $stmt = $conn->prepare("SELECT * FROM users ORDER BY user_id;");
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
        <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 ">
                                        <thead class="table-light"> 
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Post ID</th>
                                                <th scope="col">Post Title</th>
                                                <th scope="col">Post Details</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">User ID</th>
                                                <th scope="col">Time Posted</th>
                                                <th scope="col">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $stmt = $conn->prepare("SELECT categories.cate_name, categories.category_id, posts.post_id, posts.post_title, posts.post_content, posts.user_id, posts.post_time FROM categories INNER JOIN posts ON posts.category_id = categories.category_id ORDER BY posts.post_time;");
                                                $stmt->execute();
                                            ?>
                                            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td><a href="postDetail.php?post_id=<?= $row['post_id'] ?>" style="color: black;"><?= $row['post_id'] ?></a></td>
                                                    <td class="truncate-text"><?= $row['post_title'] ?></td>
                                                    <td class="truncate-text"><?= $row['post_content'] ?></td>
                                                    <td class="truncate-text"><?= $row['cate_name'] ?></td>
                                                    <td><?= $row['user_id'] ?></td>
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
                                                                        Are you sure you want to delete "<?= $row['post_title'] ?>"     ?
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
                                                                        <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                                                            <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>">
                                                                            <div class="mb-3">
                                                                                <label for="post_title" class="form-label">Post Title</label>
                                                                                <input type="text" class="form-control" id="post_title" name="post_title" value="<?= htmlspecialchars($row['post_title']) ?>" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="post_content" class="form-label">Post Details</label>
                                                                                <textarea type="text" class="form-control" rows="5" id="post_content" name="post_content" required><?= htmlspecialchars($row['post_content']) ?></textarea >
                                                                            </div>
                                                                            <div class="mb-3">Post Category</label>
                                                                                <select class="form-control mt-2" id="category_id" name="category_id" required>
                                                                                <option value="<?= $row['category_id'] ?>" <?= $row['category_id'] == $row['category_id'] ? 'selected' : '' ?>><?=    $row['cate_name'] ?></option>
                                                                                    <?php
                                                                                    $cate = $conn->query("SELECT * FROM categories"); 
                                                                                    $cate->execute();
                                                                                    while ($row = $cate->fetch(PDO::FETCH_ASSOC)) {
                                                                                        echo "<option value='{$row['category_id']}'>{$row['cate_name']}</option>";
                                                                                    } ?>
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
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 ">
                                        <thead class="table-light"> 
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Comments ID</th>
                                                <th scope="col">Comment Details</th>
                                                <th scope="col">Post ID</th>
                                                <th scope="col">Users ID</th>
                                                <th scope="col">Time Commented</th>
                                                <th scope="col">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $stmt = $conn->prepare("SELECT * FROM comments ORDER BY com_date;");
                                                $stmt->execute();
                                            ?>
                                            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td><?= $row['comment_id'] ?></td>
                                                    <td class="truncate-text"><?= $row['com_detail'] ?></td>
                                                    <td class="truncate-text"><a href="postDetail.php?post_id=<?= $row['post_id'] ?>" style="color: black;"><?= $row['post_id'] ?></a></td>
                                                    <td><?= $row['user_id'] ?></td>
                                                    <td><?= $row['com_date'] ?></td>

                                                    <td>
                                                        <a role="button" class="btn btn-success btn-sm px-2" href="comEdit.php?comment_id=<?= $row['comment_id'] ?>&post_id=<?= $row['post_id'] ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm px-2" onclick="confirmDelete(<?= $row['comment_id'] ?>)">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>

                                                        <!-- Modal for Delete -->
                                                        <form id="deleteForm<?= $row['comment_id'] ?>" action="comDelete.php" method="POST" style="display:none;">
                                                            <input type="hidden" name="comment_id" value="<?= $row['comment_id'] ?>">
                                                            <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>"> <!-- เพื่อให้กลับไปที่หน้า post นั้นหลังจากลบ -->
                                                        </form>

                                                        <!-- Modal for Edit -->
                                                        <div class="modal fade" id="editModal<?= $row['comment_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['comment_id'] ?>" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel<?= $row['comment_id']?>">Edit Comment</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Edit form inside modal -->
                                                                        <form action="comUpdate.php" method="POST">
                                                                            <input type="hidden" name="comment_id" value="<?=$row['comment_id']?>">
                                                                            <div class="mb-3">
                                                                                <label for="com_detail" class="form-label">Comment Detail</label>
                                                                                <input type="text" class="form-control" id="com_detail" name="com_detail" value="<?= htmlspecialchars($row['com_detail']) ?>" required>
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
    </div> 
</div>
</body>
</html>