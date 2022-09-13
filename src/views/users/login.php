<h1>Login</h1>
<nav>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
  </ul>
</nav>
<form action="<?= BASEURL; ?>/users/signin" method="POST">
  <div>
    <input type="text" name="user" id="user" placeholder="Username/Email" required autofocus>
  </div>
  <div>
    <input type="password" name="password" id="password" placeholder="Password" required>
  </div>
  <button>Login</button>
</form>
<div>
  <a href="?reset=true">Forgot Password</a>
</div>
<div>
  <a href="?register=true">Register</a>
</div>
<div><?php Flasher::flash(); ?></div>