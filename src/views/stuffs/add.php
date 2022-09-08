<nav>
  <h1>Add Stuff</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
    <li><a href="<?= BASEURL; ?>/users">User</a></li>
  </ul>
</nav>
<form action="<?= BASEURL; ?>/stuffs/create" method="POST">
  <div>
    <input type="text" name="name" id="name" placeholder="Stuff name">
  </div>
  <div>
    <input type="text" name="description" id="description" placeholder="Stuff description">
  </div>
  <div>
    <select name="category" id="category">
      <option value="">-- Choose category --</option>
      <?php foreach ($data['categories'] as $category) : ?>
      <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit">Add</button>
</form>
<a href="<?= BASEURL; ?>/stuffs">Back</a>