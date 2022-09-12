<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<form action="<?= BASEURL; ?>/users/update" method="POST">
  <div>
    <input type="password" name="old_password" id="old_password" placeholder="Old password">
  </div>
  <div>
    <input type="password" name="new_password" id="new_password" placeholder="New password">
  </div>
  <button type="submit" onclick="return confirm('Are you sure?')">Save</button>
</form>

<a href="<?= BASEURL; ?>/profile">Back</a>