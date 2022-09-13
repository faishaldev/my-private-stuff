<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<h1>Add Category</h1>
<form action="<?= BASEURL; ?>/categories/create" method="POST">
  <input type="hidden" name="username" id="username" value="<?= $_SESSION['username']; ?>">
  <div>
    <input type="text" name="name" id="name" placeholder="Category name" required autofocus>
  </div>
  <div>
    <input type="text" name="description" id="description" placeholder="Category description">
  </div>
  <button type="submit">Add</button>
</form>

<a href="<?= BASEURL; ?>/categories">Back</a>