<nav>
  <h1>Edit Category</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
    <li><a href="<?= BASEURL; ?>/users">User</a></li>
  </ul>
</nav>
<form action="<?= BASEURL; ?>/categories/update" method="POST">
  <input type="hidden" name="id" id="id" value="<?= $data['category']['id']; ?>">
  <div>
    <input type="text" name="name" id="name" placeholder="Stuff name" value="<?= $data['category']['name']; ?>">
  </div>
  <div>
    <input type="text" name="description" id="description" placeholder="Stuff description" value="<?= $data['category']['description']; ?>">
  </div>
  <button type="submit">Save</button>
</form>

<a href="<?= BASEURL; ?>/categories">Back</a>