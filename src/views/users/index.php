<nav>
  <h1>User</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
    <li><a href="<?= BASEURL; ?>/users">User</a></li>
  </ul>
</nav>
<a href="<?= BASEURL; ?>/users/add">Add User</a>
<h1>Daftar User</h1>
<table>
  <tr>
    <th>No</th>
    <th>Username</th>
    <th>Email</th>
    <th>Full Name</th>
    <th>Phone Number</th>
    <th>Address</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php $no = 1 ?>
  <?php foreach ($data['users'] as $user) : ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= $user['username']; ?></td>
    <td><?= $user['email']; ?></td>
    <td><?= $user['fullname']; ?></td>
    <td><?= $user['phonenumber']; ?></td>
    <td><?= $user['address']; ?></td>
    <td>
      <?php
        if ($user['is_active']) {
          if ($user['is_deleted']) {
            echo 'Deleted';
          } else {
            echo 'Active';
          }
        } else {
          if ($user['is_deleted']) {
            echo 'Deleted';
          } else {
            echo 'Inactive';
          }
        }
      ?>
    </td>
    <td>
      <?php
        if ($user['is_active']) {
          if ($user['is_deleted']) { ?>
            <form action="<?= BASEURL; ?>/users/recovery/<?= $user['id']; ?>" method="POST">
              <button type="submit" onclick="return confirm('Are you sure?')">Recovery</button>
            </form>
          <?php
          } else {?>
            <form action="<?= BASEURL; ?>/users/edit/<?= $user['id']; ?>" method="POST">
              <button type="submit">Edit</button>
            </form>
            <form action="<?= BASEURL; ?>/users/deactivate/<?= $user['id']; ?>" method="POST">
              <button type="submit" onclick="return confirm('Are you sure?')">Deactivate</button>
            </form>
            <form action="<?= BASEURL; ?>/users/delete/<?= $user['id']; ?>" method="POST">
              <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        <?php
          }
        } else {
          if ($user['is_deleted']) { ?>
            <form action="<?= BASEURL; ?>/users/recovery/<?= $user['id']; ?>" method="POST">
              <button type="submit" onclick="return confirm('Are you sure?')">Recovery</button>
            </form>
          <?php
          } else { ?>
            <form action="<?= BASEURL; ?>/users/activate/<?= $user['id']; ?>" method="POST">
              <button type="submit" onclick="return confirm('Are you sure?')">Activate</button>
            </form>
            <form form action="<?= BASEURL; ?>/users/delete/<?= $user['id']; ?>" method="POST">
              <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
          <?php
          } ?>
      <?php
        }
      ?>
    </td>
  </tr>
  <?php endforeach; ?>
</table>