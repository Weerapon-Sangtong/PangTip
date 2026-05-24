<?php require 'req/navbar.php' 
?>


<!DOCTYPE html> 
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <?php
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert p-3">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success role="alert p-3">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
?>
<?php
  if(isset($_SESSION['user_login'])){
      $user_id = $_SESSION['user_login'];
  } else if(isset($_SESSION['admin_login'])){
      $user_id = $_SESSION['admin_login'];
  }
?>

<div class="container mt-4">
  <?php 
    $post_id = $_GET['post_id'];
    $check_data = $conn->prepare("SELECT users.user_id, users.firstname, users.lastname, posts.post_id, posts.post_title, posts.post_content, posts.post_time FROM users INNER JOIN posts ON users.user_id = posts.user_id WHERE post_id = :post_id");
    $check_data->bindParam(":post_id", $post_id);
    $check_data->execute();
    $row = $check_data->fetch(PDO::FETCH_ASSOC);?>
        <div class="container mb-4">
        <div class="card p-3"><h2>
        <?=$row['post_title']?></h2>
        <hr>
        <?php
            if (isset($user_id)) {
              $stmt = $conn->prepare("SELECT user_id FROM posts WHERE post_id = :post_id");
              $stmt->bindParam(":post_id", $post_id);
              $stmt->execute();
              $post_owner = $stmt->fetchColumn();
          
              if ($user_id == $post_owner || isset($_SESSION['admin_login'])) {
                  echo '<div class="container">
                        <a role="button" class="btn btn-success btn-sm px-2" href="postEdit.php?post_id='.$row['post_id'].'">
                          <i class="fa-solid fa-pen-to-square"> แก้ไขโพสต์</i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm px-2" data-bs-toggle="modal" data-bs-target="#deleteModal'.$row['post_id'].'">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="modal fade" id="deleteModal'.$row['post_id'].'" tabindex="-1" aria-labelledby="deleteModalLabel'.$row['post_id'].'" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="deleteModalLabel'.$row['post_id'].'">Confirm Delete</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      Are you sure you want to delete "'.$row['post_title'].'"     ?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                      <!-- Delete form -->
                                      <form action="postDelete.php" method="POST">
                                          <input type="hidden" name="post_id" value="'.$row['post_id'].'">
                                          <button type="submit" class="btn btn-danger">Delete</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                        </div>';
              }
          }
        ?>
        <p style="font-size: 20px;" class="p-3"><?=nl2br(htmlspecialchars($row['post_content']))?></p>
        <hr>Posted by <?=$row['firstname']?> / <?=$row['post_time']?> / Post ID : <?=$row['post_id']?></div>
        </div>
        </div>

<title><?php echo htmlspecialchars($row['post_title']); ?></title>

  <hr>
<?php 
  if(isset($_SESSION['user_login'])){
  $user_id = $_SESSION['user_login'];
  }else if(isset($_SESSION['admin_login'])){
  $user_id = $_SESSION['admin_login'];
  }
  $check_data = $conn->prepare("SELECT * FROM users WHERE user_id = :user_id");
  $check_data->bindParam(":user_id", $user_id);
  $check_data->execute();
  $row = $check_data->fetch(PDO::FETCH_ASSOC);
?>
<div class="contianer mb-4" style="max-width:250px;"><h1 style="position: relative; left:250px;">Comments</h1></div>
<form action="comment_db.php" method="POST">
  <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
  <div class="container mb-2">
    <div class="container card p-3">
        <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-1 col-form-label"><b>Name</b></label>
        <div class="col-sm-2">
          <div class="form-control-plaintext d-flex"><?php echo $row['firstname'].'    '.$row['lastname']; ?></div>
        </div>
      </div>
      <div class="mb-3 row">
      <label for="comment" class="col col-form-label"><b>Comment</b></label>
      <div class="col-sm-12">
        <textarea type="text" rows="4" class="form-control" name="comment" id="comment"></textarea>
      </div>
    </div>
    <button type="submit" name="postcomment" class="btn btn-secondary w-25" style="position: relative; left:106px;">Post Comment</button>
  </div>
  </div>
  </form>
    <?php 
          $post_id = $_GET['post_id'];
          $stmt = $conn->prepare("SELECT users.firstname, users.lastname, comments.com_detail, comments.user_id, comments.comment_id, comments.com_date 
                                  FROM comments
                                  JOIN users ON comments.user_id = users.user_id
                                  WHERE comments.post_id = :post_id
                                  ORDER BY comments.com_date DESC");
          $stmt->bindParam(':post_id', $post_id);
          $stmt->execute();
          
    
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $user_id = null;

            if(isset($_SESSION['user_login'])){
              $user_id = $_SESSION['user_login'];
              }else if(isset($_SESSION['admin_login'])){
              $user_id = $_SESSION['admin_login'];
              }
            ?>
              <div class="container mb-4">
              <div class="container card p-3 hfx">
              <h4><?=htmlspecialchars($row['firstname'])?></h4>
              <p><?=htmlspecialchars($row['com_detail'])?></p>
              <p class="fdate">
              <?php
              if ($user_id == $row['user_id'] || isset($_SESSION['admin_login'])) {
                echo '<a style="color: red;" role="button" data-bs-toggle="modal" data-bs-target="#deleteModal'. $row['comment_id'].'">Delete</a>
                    / <a style="color: green;" role="button" data-bs-toggle="modal" data-bs-target="#editModal'.$row['comment_id'].'">Edit</a>
                    /.';}?> <?=htmlspecialchars($row['com_date'])?> / Comment ID : <?=htmlspecialchars($row['comment_id'])?></p>
              </div>
              </div>

            <!-- Edit -->
            <div class="modal fade" id="editModal<?= $row['comment_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['comment_id'] ?>" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel<?= $row['comment_id'] ?>">Edit Comment</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <!-- Edit form inside modal -->
                          <form action="comUpdate.php" method="POST">
                              <input type="hidden" name="post_id" value="<?=$post_id?>">
                              <input type="hidden" name="comment_id" value="<?= $row['comment_id'] ?>">
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

            <!--Delete--->
            <div class="modal fade" id="deleteModal<?= $row['comment_id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $row['comment_id'] ?>" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="deleteModalLabel<?= $row['comment_id'] ?>">Confirm Delete</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          Are you sure you want to delete <p class="truncate-text">"<?= $row['com_detail'] ?>" ?</p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <!-- Delete form -->
                          <form action="adcomDelete.php" method="POST">
                          <input type="hidden" name="comment_id" value="<?= $row['comment_id'] ?>">
                              <input type="hidden" name="post_id" value="<?=$post_id?>">
                              <button type="submit" class="btn btn-danger">Delete</button>
                              
                          </form>
                      </div>
                  </div>
              </div>
          </div>
    <?php } ?>
  <div class="container mb-5">
    <div class="card"></div>
  </div>
</div>
</body>
</html>