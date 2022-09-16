<h1>Forgot Password</h1>
<nav>
  <ul>
    <li><a href="<?= BASEURL; ?>">Home</a></li>
  </ul>
</nav>
<form action="<?= BASEURL; ?>/forgot/password" method="POST">
  <div>
    <input type="text" name="email" id="email" placeholder="Email" required autofocus>
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