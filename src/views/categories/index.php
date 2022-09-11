<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

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
<div><?php Flasher::flash(); ?></div>