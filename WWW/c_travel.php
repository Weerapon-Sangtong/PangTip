<?php
    require 'req/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Travels and Life Style</title>
</head>
<body>
    
<div class="container card mt-4">
    <div class="container mt-4">
      <h1>Travels and Life Style</h1>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-3 mt-4 mb-4">
        <div class="col">
             <h5 class="card-title">กระทู้ทั้งหมด</h5>
        </div>
    </div>

    <?php 
        $check_data = $conn->prepare("SELECT * FROM posts WHERE category_id = :category_id");
        $cat = 6;
        $check_data->bindParam(":category_id", $cat );
        $check_data->execute();
        
        while($row = $check_data->fetch(PDO::FETCH_ASSOC)) {
            echo '<div style="border: 1px solid #ddd; padding: 7px; margin-bottom: 15px; border-radius: 5px; background-color: #f9f9f9;">';
            echo '<a href="postDetail.php?post_id='.$row['post_id'].'" class="text-decoration-none text-dark" >';
            echo '<div style="margin-top: 10px; font-size: 30px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">';
            echo  htmlspecialchars($row['post_title']) ; // ลิงก์ไปยังหน้ารายละเอียด
            echo '<div style="margin-top: 10px; font-size: 16px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">' 
                    . htmlspecialchars($row['post_content']) . '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
    ?>
</body>
</html>