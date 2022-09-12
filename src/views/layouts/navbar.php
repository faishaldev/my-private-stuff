<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<nav>
  <h1>Hi <?= $_SESSION['username']; ?></h1>
  <h2>About</h2>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/dashboard">Dashboard</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Categories</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuffs</a></li>
    <?= $data['role'] === 'Admin' ? '<li><a href="' . BASEURL . '/users">Users</a></li>' : ''; ?>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
    <li><a href="<?= BASEURL; ?>/profile">Profile</a></li>
    <li><a href="<?= BASEURL; ?>/users/logout" onclick="return confirm('Are you sure?')">Logout</a></li>
  </ul>
</nav>