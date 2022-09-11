<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

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
    <?= $data['role'] === 'Admin' ? '<th>Owner</th>' : '' ; ?>
    <th>Action</th>
  </tr>
  <?php $no = 1 ?>
  <?php foreach ($data['stuffs'] as $stuff) : ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= $stuff['name']; ?></td>
    <td><?= $stuff['description']; ?></td>
    <td><?= $stuff['category_name']; ?></td>
    <?= $data['role'] === 'Admin' ? '<td>' . $stuff['user_username'] . '</td>': ''; ?>
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
<div><?php Flasher::flash(); ?></div>