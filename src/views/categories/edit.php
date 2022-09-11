<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<form action="<?= BASEURL; ?>/categories/update" method="POST">
  <input type="hidden" name="id" id="id" value="<?= $data['category']['id']; ?>">
  <div>
    <input type="text" name="name" id="name" placeholder="Category name" value="<?= $data['category']['name']; ?>">
  </div>
  <div>
    <input type="text" name="description" id="description" placeholder="Category description" value="<?= $data['category']['description']; ?>">
  </div>
  <button type="submit">Save</button>
</form>
<a href="<?= BASEURL; ?>/categories">Back</a>