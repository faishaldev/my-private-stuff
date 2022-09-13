<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<h1>Change Password</h1>
<form action="<?= BASEURL; ?>/profile/password" method="POST">
  <div>
    <input type="password" name="old_password" id="old_password" placeholder="Old password" required autofocus>
  </div>
  <div>
    <input type="password" name="new_password" id="new_password" placeholder="New password" required>
  </div>
  <button type="submit" onclick="return confirm('Are you sure?')">Save</button>
</form>
<a href="<?= BASEURL; ?>/profile">Back</a>
<div><?php Flasher::flash(); ?></div>