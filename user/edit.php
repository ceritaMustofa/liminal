<?php

session_start();

if (!isset($_SESSION["login"])) {
  header("Location: ../login_register/login.php");
  exit;
}

include("../header.php");
require("../config/functions.php");

//Ambil data di URL
$newsId = $_GET["newsId"];

$news = query("SELECT * FROM news WHERE newsId = $newsId")[0];




//Cek apakah submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
  //JIka sudah
  //cek apakah data berhasil diubah
  if (edit($_POST) > 0) {
    echo "
    <script>
    alert ('Data berhasil diubah');
    document.location.href='../index.php';
    </script>";
  } else {
    echo "
  <script>
  alert('Data gagal diubah!');
  document.location.href='../index.php';
  </script>";
  }
}

?>



<div class="container py-2">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <input type="hidden" name="newsId" class="form-control" id="newsId" value="<?= ($news['newsId']) ?>">
    </div>
    <div class="form-group">
      <input type="hidden" name="oldImage" class="form-control" id="newsId" value="<?= ($news['images']) ?>">
    </div>
    <div class="form-group">
      <input type="text" required name="title" class="form-control" id="title" placeholder="Title" value="<?= ($news['title']) ?>">
    </div>
    <div class="form-group">
      <input type="text" required name="category" class="form-control" id="category" placeholder="category" value="<?= ($news['category']) ?>">
    </div>
    <div class="form-group">
      <textarea class="form-control" required name="content" id="content" rows="18" col="50" placeholder="Content here...!!" value="<?= ($news['content']) ?>"></textarea>
    </div>
    <div class="form-group">
      <img src="../img/<?= $news['images'] ?>" alt="" width="100">
      <input type="file" name="images" class="form-control-file" id="images">
    </div>
    <div class="form-grup">
      <button class="btn btn-danger" type="submit" name="submit">Post</button>
    </div>
  </form>
</div>

























<?php

include("../footer.php");

?>