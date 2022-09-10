<?php
if (!isset($_SESSION)) {
  session_start();
}

$username = $_SESSION['username'];
?>
<nav>
  <h1>Add Category</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
    <li><a href="<?= BASEURL; ?>/users">User</a></li>
  </ul>
</nav>
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