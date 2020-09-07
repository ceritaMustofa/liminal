<?php

session_start();

if (!isset($_SESSION["login"])) {
  header("Location: ../login_register/login.php");
  exit;
}

require('../header.php');
require("../config/fucntions.php");

$newsId = $_GET['newsId'];

if (hapus($newsId) > 0) {
  echo "
  <script>
  alert ('Data berhasil dihapus');
  document.location.href='../index.php';
  </script>";
} else {
  echo "
  <script>
  alert ('Data gagal dihapus');
  document.location.href='../index.php';
  </script>";
}
