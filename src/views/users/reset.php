<h1>Reset Password</h1>
<form action="<?= BASEURL; ?>/users/password" method="POST">
  <div>
    <input type="text" name="user" id="user" placeholder="Username/Email" required>
  </div>
  <button>Submit</button>
</form>
<div>
<a href="?login=true">Login</a>
</div>
<div>
  <a href="?register=true">Register</a>
</div>
<div><?php Flasher::flash(); ?></div>