<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<form action="<?= BASEURL; ?>/stuffs/create" method="POST">
  <input type="hidden" name="username" id="username" value="<?= $username; ?>">
  <div>
    <input type="text" name="name" id="name" placeholder="Stuff name">
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