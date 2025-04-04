<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<h1>Add User</h1>
<form action="<?= BASEURL; ?>/users/create" method="POST">
  <div>
    <input type="text" name="username" id="username" placeholder="Username" required autofocus>
  </div>
  <div>
    <input type="text" name="fullname" id="fullname" placeholder="Full name" required>
  </div>
  <div>
    <input type="email" name="email" id="email" placeholder="Email" required>
  </div>
  <div>
    <input type="phone" name="phonenumber" id="phonenumber" placeholder="Phone number" required>
  </div>
  <div>
    <input type="text" name="address" id="address" placeholder="Address" required>
  </div>
  <div>
    <input type="password" name="password" id="password" placeholder="Password" required>
  </div>
  <button type="submit">Add</button>
</form>
<a href="<?= BASEURL; ?>/users">Back</a>
<div><?php Flasher::flash(); ?></div>