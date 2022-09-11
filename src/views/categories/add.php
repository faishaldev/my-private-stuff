<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<form action="<?= BASEURL; ?>/categories/create" method="POST">
  <input type="hidden" name="username" id="username" value="<?= $username; ?>">
  <div>
    <input type="text" name="name" id="name" placeholder="Category name">
  </div>
  <div>
    <input type="text" name="description" id="description" placeholder="Category description">
  </div>
  <button type="submit">Add</button>
</form>

<a href="<?= BASEURL; ?>/categories">Back</a>