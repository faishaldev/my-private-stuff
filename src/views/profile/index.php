<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<h2>Your Profile Information</h2>
<table>
  <tr>
    <th>Username</th>
    <td><?= $data['user']['username']; ?></td>
  </tr>
  <tr>
    <th>Full Name</th>
    <td><?= $data['user']['fullname']; ?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?= $data['user']['email']; ?></td>
  </tr>
  <tr>
    <th>Phone Number</th>
    <td><?= $data['user']['phonenumber']; ?></td>
  </tr>
  <tr>
    <th>Address</th>
    <td><?= $data['user']['address']; ?></td>
  </tr>
</table>
<div>
  <a href="<?= BASEURL; ?>/profile/edit/<?= $data['user']['id']; ?>">Change the profile</a>
</div>
<div>
  <a href="<?= BASEURL; ?>/profile/change">Change the password</a>
</div>
<?php Flasher::flash(); ?>