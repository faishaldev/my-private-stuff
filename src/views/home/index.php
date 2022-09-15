<header>
  <h1>Home</h1>
  <nav>
    <ul>
      <?php if (!isset($_SESSION['username'])) { ?>
        <li><a href="?login=true">Login</a></li>
        <li><a href="?register=true">Register</a></li>
        <li><a href="?about=true">About</a></li>
      <?php } else { ?>
        <li><a href="<?= BASEURL; ?>/dashboard">Dashboard</a></li>
        <li><a href="<?= BASEURL; ?>/users/logout" onclick="return confirm('Are you sure?')">Logout</a></li>
      <?php } ?>
    </ul>
  </nav>
  <h2>My Private Stuff</h2>
  <h3>A Stuff Manager for You</h3>
  <h4>It will makes you easy to manage your private stuff</h4>
  <h5>You can also borrow stuff to other user with an owner permission</h5>
</header>
<div><?php Flasher::flash(); ?></div>