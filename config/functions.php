<?php
require("connect.php");

function query($query)
{
  global $connect;
  $result = mysqli_query($connect, $query);
  $newsList = [];
  while ($news = mysqli_fetch_assoc($result)) {
    $newsList[] = $news;
  }
  return $newsList;
}


function tambah($data)
{
  global $connect;

  $title = htmlspecialchars($data["title"]);
  $category = htmlspecialchars($data["category"]);
  $content = htmlspecialchars($data["content"]);

  // upload gambar
  $images = upload();
  if (!$images) {
    return false;
  }

  //tanggal posting
  $postDate = date('Y-m-d H:i:s');


  $query = "INSERT INTO news
  VALUES ('', '$title', '$category', '$content', '$images', '$postDate' )";


  mysqli_query($connect, $query);

  return mysqli_affected_rows($connect);
}

function upload()
{
  $fileName = $_FILES['images']['name'];
  $fileSize = $_FILES['images']['size'];
  $error = $_FILES['images']['error'];
  $tmpName = $_FILES['images']['tmp_name'];

  //validasi gambar
  //apakah gambar ada
  if ($error === 4) {
    echo "<script>
      alert ('Please select image first!')
      </script>";
    return false;
  }


  //cek apakah yg dikirim adalah gambar
  $validImgExtentnion = ['jpg', 'jpeg', 'png'];
  $imgExtention = explode('.', $fileName);
  $imgExtention = strtolower(end($imgExtention));
  if (!in_array($imgExtention, $validImgExtentnion)) {
    echo "<script>
    alert ('Only image can be submited!')
    </script>";
    return false;
  }

  //validasi ukuran gambar
  if ($fileSize > 1000000) {
    echo "<script>
      alert ('The file is to large!')
      </script>";
    return false;
  }

  //jika valid, pindahkan ke direktory
  //generate nama baru
  $newFileName = uniqid();
  $newFileName .= '.';
  $newFileName .= $imgExtention;



  move_uploaded_file($tmpName, '../img/' . $newFileName);

  return $newFileName;
}


function hapus($newsId)
{
  global $connect;
  mysqli_query($connect, "DELETE FROM news WHERE newsId =$newsId ");

  return mysqli_affected_rows($connect);
}


function edit($data)
{
  global $connect;

  $newsId = $data["newsId"];
  $title = htmlspecialchars($data["title"]);
  $category = htmlspecialchars($data["category"]);
  $content = htmlspecialchars($data["content"]);
  $oldImage = htmlspecialchars($data["oldImage"]);

  //cek apakah user pilih gambar baru atau tidak
  if ($_FILES['images']['error'] === 4) {
    $images = $oldImage;
  } else {
    $images = upload();
  }


  $query = "UPDATE news SET
  title = '$title',
  category = '$category',
  content = '$content',
  images = '$images'
  WHERE newsId = $newsId";


  mysqli_query($connect, $query);

  return mysqli_affected_rows($connect);
}

function search($keyword)
{
  $query = "SELECT * FROM news 
  WHERE title LIKE '%$keyword%' OR category LIKE '%$keyword%' OR content LIKE '%$keyword%'";

  return query($query);
}

function register($data)
{
  global $connect;

  $firstName =  mysqli_real_escape_string($connect, $data["firstName"]);
  $lastName =  mysqli_real_escape_string($connect, $data["lastName"]);
  $email = $data["email"];
  $password = mysqli_real_escape_string($connect, $data["password"]);
  $password2 = mysqli_real_escape_string($connect, $data["password2"]);

  //cek apakah username sudah ada atau belum
  $result = mysqli_query($connect, "SELECT email FROM users WHERE  email = '$email'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
      alert ('email sudah terdaftar!')
    </script>";

    return false;
  }

  // cek confirmasi password
  if ($password !== $password2) {
    echo "<script>
       alert ('Password did not match')
    </script>";

    return false;
  }

  //encrypt password
  $password = password_hash($password, PASSWORD_DEFAULT);

  //input tanggal daftar
  $registerDate = date('Y-m-d H:i:s');

  //tambahkan user
  mysqli_query($connect, "INSERT INTO users VALUES('','$firstName','$lastName','$email','$password','$registerDate')");

  return mysqli_affected_rows($connect);
}

