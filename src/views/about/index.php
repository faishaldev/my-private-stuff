<?php
if (!isset($_SESSION)) {
  session_start();
}

$name = $_SESSION['username'];
?>
<h1>Hi <?= $name; ?></h1>
<nav>
  <h1>About</h1>
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
  <a href="<?= BASEURL; ?>/users/logout" onclick="return confirm('Are you sure?')">Logout</a>
</div>
<h1>What is My Private Stuff?</h1>
<p>My Private Stuff is an web application built with PHP and MVC Architecture to help you manage your private stuff</p>