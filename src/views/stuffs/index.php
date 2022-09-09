<?php
if (!isset($_SESSION)) {
  session_start();
}

$name = $_SESSION['username'];
?>

<h1>Hi <?= $name; ?></h1>
<nav>
  <h1>Stuff</h1>
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
<div>
<a href="<?= BASEURL; ?>/stuffs/add">Add Stuff</a>
</div>
<h1>Stuffs List</h1>
<table>
  <tr>
    <th>No</th>
    <th>Name</th>
    <th>Description</th>
    <th>Category</th>
    <th>Owner</th>
    <th>Action</th>
  </tr>
  <?php $no = 1 ?>
  <?php foreach ($data['stuffs'] as $stuff) : ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= $stuff['name']; ?></td>
    <td><?= $stuff['description']; ?></td>
    <td><?= $stuff['category_name']; ?></td>
    <td><?= $stuff['user_username']; ?></td>
    <td>
      <form action="<?= BASEURL; ?>/stuffs/edit/<?= $stuff['id']; ?>" method="POST">
        <button type="submit">Edit</button>
      </form>
      <form action="<?= BASEURL; ?>/stuffs/delete/<?= $stuff['id']; ?>" method="POST">
        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>