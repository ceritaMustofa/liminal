<?php


include("header.php");
require("config/functions.php");

$newsList = query("SELECT * FROM news ORDER BY newsId DESC");

if (isset($_POST['search'])) {
  $newsList = search($_POST['keyword']);
}

?>

<div class="navbar d-flex mr-auto">
  <a href="login_register/logout.php"><span><i class="material-icons">power_settings_new</i></span></a>
</div>

<div class="container-fluid py-2">
  <h1>News list</h1>
  <nav class="navbar">
    <a href="user/addPost.php" class="mt-2"><button class="btn btn-outline-success">Add post</button></a>
    <form action="" method="post" class="form-inline mt-2">
      <input class="form-control mr-sm-2" name="keyword" type="search" placeholder="Search" aria-label="Search" size="40" autocomplete>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
    </form>
  </nav>


  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Content</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>

    <?php foreach ($newsList as $news) : ?>

      <tr>
        <td><?= $news["title"] ?></td>
        <td><?= $news["category"] ?></td>
        <td><?= $news["content"] ?></td>
        <td><img src="img/<?= $news["images"] ?>" alt="images" width="50"></td>
        <td>
          <div class="d-flex">

            <a href="user/edit.php?newsId=<?= $news["newsId"]; ?>"><span><i class="material-icons">create</i></span></a> |

            <a href="user/delete.php?newsId=<?= $news["newsId"]; ?>" onclick="return confirm('Are you sure?')"><span><i class="material-icons">delete</i></span></a>

          </div>
        </td>
      </tr>
    <?php endforeach ?>
  </table>

</div>







































<?php

include("footer.php");

?>