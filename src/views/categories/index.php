<nav>
  <h1>Category</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/dashboard">Dashboard</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <li><a href="<?= BASEURL; ?>/users">User</a></li>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
  </ul>
</nav>
<a href="<?= BASEURL; ?>/categories/add">Add Category</a>
<h1>Categories List</h1>
<table>
  <tr>
    <th>No</th>
    <th>Name</th>
    <th>Description</th>
    <th>Action</th>
  </tr>
  <?php $no = 1 ?>
  <?php foreach ($data['categories'] as $category) : ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= $category['name']; ?></td>
    <td><?= $category['description']; ?></td>
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