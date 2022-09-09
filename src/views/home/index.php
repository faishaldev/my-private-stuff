<?php
if (!isset($_SESSION)) {
  session_start();
}

$name = $_SESSION['username'];
?>

<h1>Hi <?= $name; ?></h1>
<nav>
  <h1>Home</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/dashboard">Dashboard</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <li><a href="<?= BASEURL; ?>/users">User</a></li>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
  </ul>
</nav>
<div>
  <a href="<?= BASEURL; ?>/users/logout">Logout</a>
</div>
<header>
  <h1>My Private Stuff</h1>
  <h2>A Stuff Manager for You</h2>
  <h3>It will makes you easy to manage your private stuff</h3>
  <h4>You can also borrow stuff to other user with an owner permission</h4>
</header>