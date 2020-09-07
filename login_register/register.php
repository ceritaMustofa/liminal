<?php

session_start();

if (isset($_SESSION["login"])) {
  header("Location: ../index.php");
  exit;
}

include("../header.php")

?>

<?php

if (isset($_POST["signUp"])) {

  if (register($_POST) > 0) {
    echo "<script>
    alert('user baru berhasil ditambahkan!')
    </script> ";
  } else {
    echo mysqli_error($connect);
  }
}


?>

<div class="col-4 py-5 ml-5">
  <div class="text-center">
    <h1>Registration</h1>
    <p class="text-muted font-italic">I already have account <a href="login.php" class="text-decoration-none"> Login </a></p>
  </div>
  <form action="" method="post">
    <div class="form-row mt-3">
      <div class="form-group col-md-6">
        <input type="text" name="firstName" class="form-control" placeholder="First name">
      </div>
      <div class="form-group col-md-6">
        <input type="text" name="lastName" class="form-control" placeholder="Last name">
      </div>
    </div>
    <div class="form-group">
      <input type="email" name="email" class="form-control" placeholder="E-mail">
    </div>
    <div class="form-group">
      <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
      <input type="password" name="password2" class="form-control" placeholder="Confirm password">
    </div>

    <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
          Agree to terms and conditions
        </label>
        <div class="invalid-feedback">
          You must agree before submitting.
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="sm-10">
        <button type="submit" name="signUp" class="btn btn-outline-success">Sign up</button>
      </div>
    </div>

  </form>
</div>










































<?php

include("../footer.php")

?>