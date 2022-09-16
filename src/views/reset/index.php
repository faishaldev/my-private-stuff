<h1>Reset Password</h1>
<nav>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
  </ul>
</nav>
<form action="<?= BASEURL; ?>/reset/password" method="POST">
  <input type="text" name="id" id="id" value="<?= $_GET['id']; ?>">
  <div>
    <input type="password" name="new_password" id="new_password" placeholder="New password" required>
  </div>
  <div>
    <input type="password" name="verify_new_password" id="verify_new_password" placeholder="Retype New password" required>
  </div>
  <button type="submit">Submit</button>
</form>
<div>
  <a href="?login=true">Login</a>
</div>
<div>
  <a href="?register=true">Register</a>
</div>
<div><?php Flasher::flash(); ?></div>