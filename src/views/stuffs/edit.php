<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<h1>Edit Stuff</h1>
<form action="<?= BASEURL; ?>/stuffs/update" method="POST">
  <input type="hidden" name="id" id="id" value="<?= $data['stuff']['id']; ?>">
  <div>
    <input type="text" name="name" id="name" placeholder="Stuff name" value="<?= $data['stuff']['name']; ?>">
  </div>
  <div>
    <input type="text" name="description" id="description" placeholder="Stuff description" value="<?= $data['stuff']['description']; ?>">
  </div>
  <div>
    <select name="category" id="category">
      <option value="">-- Choose category --</option>
      <?php foreach ($data['categories'] as $category) : ?>
      <option value="<?= $category['id']; ?>" <?= $data['stuff']['category_name'] === $category['name'] ? 'selected' : ''; ?>><?= $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit">Save</button>
</form>
<a href="<?= BASEURL; ?>/stuffs">Back</a>