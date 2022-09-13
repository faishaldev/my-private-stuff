<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<h1>Edit Profile</h1>
<form action="<?= BASEURL; ?>/profile/update" method="POST">
  <input type="hidden" name="id" id="id" value="<?= $data['user']['id']; ?>">
  <div>
    <input type="text" name="username" id="username" placeholder="Username" value="<?= $data['user']['username']; ?>" required>
  </div>
  <div>
    <input type="text" name="fullname" id="fullname" placeholder="Full name" value="<?= $data['user']['fullname']; ?>" required>
  </div>
  <div>
    <input type="email" name="email" id="email" placeholder="Email" value="<?= $data['user']['email']; ?>" required>
  </div>
  <div>
    <input type="phone" name="phonenumber" id="phonenumber" placeholder="Phone number" value="<?= $data['user']['phonenumber']; ?>" required>
  </div>
  <div>
    <input type="text" name="address" id="address" placeholder="Address" value="<?= $data['user']['address']; ?>" required>
  </div>
  <button type="submit" onclick="return confirm('Are you sure?')">Save</button>
</form>
<a href="<?= BASEURL; ?>/profile">Back</a>
<div><?php Flasher::flash(); ?></div>