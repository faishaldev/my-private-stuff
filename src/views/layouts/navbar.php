<?php
if (!isset($_SESSION)) {
  session_start();
}

$username = $_SESSION['username'];
?>

<nav>
  <h1>Hi <?= $username; ?></h1>
  <h2>About</h2>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/dashboard">Dashboard</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <?= $data['role'] === 'Admin' ? '<li><a href="' . BASEURL . '/users">User</a></li>' : ''; ?>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
    <li><a href="<?= BASEURL; ?>/users/profile">Profile</a></li>
    <li><a href="<?= BASEURL; ?>/users/logout" onclick="return confirm('Are you sure?')">Logout</a></li>
  </ul>
</nav>