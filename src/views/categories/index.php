<?php
if (!isset($_SESSION)) {
  session_start();
}

$username = $_SESSION['username'];
?>

<h1>Hi <?= $username; ?></h1>
<nav>
  <h1>Category</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/dashboard">Dashboard</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <?= $data['role'] === 'Admin' ? '<li><a href="' . BASEURL . '/users">User</a></li>' : ''; ?>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
  </ul>
</nav>
<div>
  <a href="<?= BASEURL; ?>/users/logout">Logout</a>
</div>
<div>
<a href="<?= BASEURL; ?>/categories/add">Add Category</a>
</div>
<h1>Categories List</h1>
<table>
  <tr>
    <th>No</th>
    <th>Name</th>
    <th>Description</th>
    <?= $data['role'] === 'Admin' ? '<th>Creator</th>' : ''; ?>
    <th>Action</th>
  </tr>
  <?php $no = 1 ?>
  <?php foreach ($data['categories'] as $category) : ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= $category['name']; ?></td>
    <td><?= $category['description']; ?></td>
    <?= $data['role'] === 'Admin' ? '<td>' . $category['username'] . '</td>' : ''; ?>
    <td>
      <form action="<?= BASEURL; ?>/categories/edit/<?= $category['id']; ?>" method="POST">
        <button type="submit">Edit</button>
      </form>
      <form action="<?= BASEURL; ?>/categories/delete/<?= $category['id']; ?>" method="POST">
        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>