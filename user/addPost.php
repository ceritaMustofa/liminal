<?php

session_start();

if (!isset($_SESSION["login"])) {
  header("Location: ../login_register/login.php");
  exit;
}

include("../header.php");
require("../config/functions.php");

//Cek apakah submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
  //JIka sudah
  //cek apakah data berhasil ditambhkan
  if (tambah($_POST) > 0) {
    echo "
    <script>
    alert ('Data berhasil ditambahkan');
    document.location.href='../index.php';
    </script>";
  } else {
    echo "
    <script>
    alert ('Data gagal ditambahkan');
    document.location.href='../index.php';
    </script>";
  }
}

?>



<div class="container py-2">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <input type="text" required name="title" class="form-control" id="title" placeholder="Title">
    </div>
    <div class="form-group">
      <input type="text" required name="category" class="form-control" id="category" placeholder="category">
    </div>
    <div class="form-group">
      <textarea class="form-control" required name="content" id="content" rows="18" col="50" placeholder="Content here...!!"></textarea>
    </div>
    <div class="form-group">
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
