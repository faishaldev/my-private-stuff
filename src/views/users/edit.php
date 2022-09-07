<nav>
  <h1>Edit User</h1>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
    <li><a href="<?= BASEURL; ?>/categories">Category</a></li>
    <li><a href="<?= BASEURL; ?>/stuffs">Stuff</a></li>
    <li><a href="<?= BASEURL; ?>/about">About</a></li>
    <li><a href="<?= BASEURL; ?>/users">User</a></li>
  </ul>
</nav>
<form action="<?= BASEURL; ?>/users/update" method="POST">
  <input type="hidden" name="id" id="id" value="<?= $data['user']['id']; ?>">
  <div>
    <input type="text" name="username" id="username" placeholder="Username" value="<?= $data['user']['username']; ?>">
  </div>
  <div>
    <input type="text" name="fullname" id="fullname" placeholder="Full name" value="<?= $data['user']['fullname']; ?>">
  </div>
  <div>
    <input type="email" name="email" id="email" placeholder="Email" value="<?= $data['user']['email']; ?>">
  </div>
  <div>
    <input type="phone" name="phonenumber" id="phonenumber" placeholder="Phone number" value="<?= $data['user']['phonenumber']; ?>">
  </div>
  <div>
    <input type="text" name="address" id="address" placeholder="Address" value="<?= $data['user']['address']; ?>">
  </div>
  <div>
    <input type="password" name="password" id="password" placeholder="Password" value="<?= $data['user']['password']; ?>">
  </div>
  <button type="submit">Save</button>
</form>

<a href="<?= BASEURL; ?>/users">Back</a>