<?php
if (!isset($_SESSION)) {
  session_start();
}

$username = $_SESSION['username'];
?>

<h1>Hi <?= $username; ?></h1>
<nav>
  <h1>User</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/dashboard">Dashboard</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <li><a href="<?= BASEURL; ?>/users">User</a></li>
    <li><a href="<?= BASEURL; ?>/users/change">Change Password</a></li>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
  </ul>
</nav>