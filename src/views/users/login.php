<h1>Login</h1>
<form action="<?= BASEURL; ?>/users/signin" method="POST">
  <div>
    <input type="text" name="user" id="user" placeholder="Username/Email">
  </div>
  <div>
    <input type="password" name="password" id="password" placeholder="Password">
  </div>
  <button>Login</button>
</form>
<a href="<?= BASEURL; ?>/users/register">Register</a>