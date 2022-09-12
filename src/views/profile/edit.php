<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<form action="<?= BASEURL; ?>/profile/update" method="POST">
  <input type="hidden" name="id" id="id" value="<?= $data['user']['id']; ?>">
  <div>
    <input type="text" name="username" id="username" placeholder="Username" value="<?= $data['user']['username']; ?>">
  </div>
  <div>
    <input type="text" name="fullname" id="fullname" placeholder="Full name" value="<?= $data['user']['fullname']; ?>">
  </div>
  <div>
    <input type="email" name="email" id="email" placeholder="Email" value="<?= $data['user']['email']; ?>">
  </div>
  <div>
    <input type="phone" name="phonenumber" id="phonenumber" placeholder="Phone number" value="<?= $data['user']['phonenumber']; ?>">
  </div>
  <div>
    <input type="text" name="address" id="address" placeholder="Address" value="<?= $data['user']['address']; ?>">
  </div>
  <button type="submit" onclick="return confirm('Are you sure?')">Save</button>
</form>

<a href="<?= BASEURL; ?>/profile">Back</a>