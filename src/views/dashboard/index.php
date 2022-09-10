<?php
if (!isset($_SESSION)) {
  session_start();
}

$username = $_SESSION['username'];
?>

<h1>Hi <?= $username; ?></h1>
<nav>
  <h1>Dashboard</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/dashboard">Dashboard</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <?= $data['role'] === 'Admin' ? '<li><a href="' . BASEURL . '/users">User</a></li>' : ''; ?>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
  </ul>
</nav>
<div>
  <a href="<?= BASEURL; ?>/users/logout">Logout</a>
</div>
<h1>Categories: <?= $data['amount_category']; ?></h1>
<h1>Stuff: <?= $data['amount_stuff']; ?></h1>