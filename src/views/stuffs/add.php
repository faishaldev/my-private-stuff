<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<h1>Add Stuff</h1>
<form action="<?= BASEURL; ?>/stuffs/create" method="POST">
  <input type="hidden" name="username" id="username" value="<?= $_SESSION['username']; ?>">
  <div>
    <input type="text" name="name" id="name" placeholder="Stuff name" required autofocus>
  </div>
  <div>
    <input type="text" name="description" id="description" placeholder="Stuff description">
  </div>
  <div>
    <select name="category" id="category" required>
      <option value="">-- Choose category --</option>
      <?php foreach ($data['categories'] as $category) : ?>
      <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit">Add</button>
</form>
<a href="<?= BASEURL; ?>/stuffs">Back</a>