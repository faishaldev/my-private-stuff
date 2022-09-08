<nav>
  <h1>Add User</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
    <li><a href="<?= BASEURL; ?>/users">User</a></li>
  </ul>
</nav>
<form action="<?= BASEURL; ?>/users/create" method="POST">
  <div>
    <input type="text" name="username" id="username" placeholder="Username">
  </div>
  <div>
    <input type="text" name="fullname" id="fullname" placeholder="Full name">
  </div>
  <div>
    <input type="email" name="email" id="email" placeholder="Email">
  </div>
  <div>
    <input type="phone" name="phonenumber" id="phonenumber" placeholder="Phone number">
  </div>
  <div>
    <input type="text" name="address" id="address" placeholder="Address">
  </div>
  <div>
    <input type="password" name="password" id="password" placeholder="Password">
  </div>
  <button type="submit">Add</button>
</form>
<a href="<?= BASEURL; ?>/users">Back</a>