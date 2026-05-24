<?php require 'req/navbar.php' 
?>


<!DOCTYPE html> 

<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
?>
<div class="container mt-4">
<?php 
   $post_id = $_GET['post_id'];
   $check_data = $conn->prepare("SELECT users.user_id, users.firstname, users.lastname, posts.post_id, posts.post_title, posts.post_content, posts.post_time FROM users INNER JOIN posts ON users.user_id = posts.user_id WHERE post_id = :post_id");
   $check_data->bindParam(":post_id", $post_id);
   $check_data->execute();
  $row = $check_data->fetch(PDO::FETCH_ASSOC);
  echo  
        '<div class="container mb-4">
        <div class="card p-3"><h2>
        '.$row['post_title'].'</h2><hr>
        <p class="p-3">'.nl2br(htmlspecialchars($row['post_content'])).'</p>
        <hr>Posted by '.$row['firstname'].' / '.$row['post_time'].'</div>
        </div>
        </div>'
   ?>
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
<form action="comment_db.php" method="POST">
  <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
  <div class="container mb-2">
    <div class="container card p-3">
        <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-1 col-form-label">Name</label>
        <div class="col-sm-2">
          <div class="form-control-plaintext d-flex"><?php echo $row['firstname'].'    '.$row['lastname']; ?></div>
        </div>
      </div>
      <div class="mb-3 row">
      <label for="comment" class="col-sm-1.2 col-form-label">Comment</label>
      <div class="col-sm-12">
        <textarea type="text" class="form-control" name="comment" id="comment"></textarea>
      </div>
    </div>
    <button type="submit" name="postcomment" class="btn btn-secondary w-25">Post Comment</button>
  </div>
  </div>
  </form>
  <?php 
        $post_id = $_GET['post_id'];
        $stmt = $conn->prepare("SELECT users.firstname, users.lastname, comments.com_detail, comments.com_date 
                                FROM comments
                                JOIN users ON comments.user_id = users.user_id
                                WHERE comments.post_id = :post_id
                                ORDER BY comments.com_date DESC");
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="container mb-4">';
            echo '<div class="container card p-3">';
            echo  '<h4>'.htmlspecialchars($row['firstname']).'</h4>' ;
            echo  '<p>'.htmlspecialchars($row['com_detail']).'</p>';
            echo  '<p class="fdate">'.htmlspecialchars($row['com_date']).'</p>';
            echo '</div>';
            echo '</div>';
        }
    ?>
  <div class="container mb-5">
    <div class="card"></div>
  </div>
</div>
</body>
</html>