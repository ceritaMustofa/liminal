<?php

session_start();

if (isset($_SESSION["login"])) {
  header("Location: ../index.php");
  exit;
}

include("../config/functions.php");

if (isset($_POST['signIn'])) {

  $email = $_POST["email"];
  $password = $_POST["password"];

  $result = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email' ");


  if (mysqli_num_rows($result) === 1) {

    //cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {

      //set session
      $_SESSION["login"] = true;

      header("location: ../index.php");

      exit;
    }
  }

  $error = true;
}



?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

  <title>Dashboard</title>
</head>

<body>
  <section>





    <div class="col-4 py-5 ml-5">
      <div class="text-center mb-5">
        <h1>Login</h1>
        <p class="text-muted font-italic">I don't have account <a href="login.php" class="text-decoration-none"> Register </a></p>
      </div>
      <?php if (isset($error)) : ?>

        <p style="color:red; font-style:italic;">Email / password salah!</p>

      <?php endif; ?>
      <form action="" method="post">
        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Email">
        </div>

        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>

        <div class="form-group">
          <div class="sm-10">
            <button type="submit" name="signIn" class="btn btn-outline-success">Sign In</button>
          </div>
        </div>

      </form>
    </div>


  </section>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
