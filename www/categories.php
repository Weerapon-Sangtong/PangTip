<?php require 'req/navbar.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container card mt-4">
    <div class="container mt-4">
      <h1>หมวดหมู่</h1>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-3 mt-4 mb-4">
        <div class="col">
          <a class="text-decoration-none text-dark" href="c_news.php" role="button">
            <div class="card hfx">
              <div class="card-body">
                <h5 class="card-title">News And Sports</h5>
                <p class="card-text text-secondary">สำหรับข่าวสาร ข้อมูลน่าสนใจและกีฬาต่างๆ</p>
              </div>
            </div>
          </a>
        </div>
      <div class="col">
        <a class="text-decoration-none text-dark" href="c_tech.php" role="button">
          <div class="card hfx">
            <div class="card-body">
              <h5 class="card-title">Technology and IT</h5>
              <p class="card-text text-secondary">สำหรับอัพเดทข้อมูลเทคโนโลยีใหม่ๆ ฮาร์ดแวร์, ซอฟท์แวร์, แอปพลิเคชั่น และ AI</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col">
        <a class="text-decoration-none text-dark" href="c_entertain.php" role="button">
          <div class="card hfx">
            <div class="card-body">
              <h5 class="card-title">Entertainments</h5>
              <p class="card-text text-secondary">สำหรับข่าวบันเทิง หนัง คนดัง ละคร ซีรียร์</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col">
        <a class="text-decoration-none text-dark" href="c_health.php" role="button">
          <div class="card hfx">
            <div class="card-body">
              <h5 class="card-title">Healths and Beauty</h5>
              <p class="card-text text-secondary">สำหรับสุขภาพและความงาม การดูแลร่างกาย การออกกำลังกาย</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col">
        <a class="text-decoration-none text-dark" href="c_educate.php" role="button">
          <div class="card hfx">
            <div class="card-body">
              <h5 class="card-title">Educations</h5>
              <p class="card-text text-secondary">สำหรับความรู้ ทักษะต่างๆ การศึกาษาต่อ</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col">
        <a class="text-decoration-none text-dark" href="c_travel.php" role="button">
          <div class="card hfx">
            <div class="card-body">
              <h5 class="card-title">Travels and Life Styles</h5>
              <p class="card-text text-secondary">พูดคุยเกี่ยวกับชีวิตประจำวัน งานอดิเรก การท่องเที่ยว แหล่งท่องเที่ยว และกิจกรรมในวันหยุด</p>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col d-flex justify-content-center align-items-center mb-4">
      <a class="text-decoration-none text-dark" href="c_game.php" role="button">
        <div class="card hfx">
          <div class="card-body">
            <h5 class="card-title">Games and E-sports</h5>
            <p class="card-text text-secondary">สำหรับข่าวสารวงการเกม เกมแนะนำ หรือถามเกี่ยวกับเกม</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</body>
</html>