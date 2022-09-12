<header>
  <h1>About</h1>
  <nav>
    <ul>
      <?php if (!isset($_SESSION['username'])) { ?>
        <li><a href="<?= BASEURL; ?>">Home</a></li>
        <li><a href="?login=true">Login</a></li>
        <li><a href="?register=true">Register</a></li>
      <?php } else { ?>
        <li><a href="<?= BASEURL; ?>/dashboard">Dashboard</a></li>
        <li><a href="<?= BASEURL; ?>/users/logout" onclick="return confirm('Are you sure?')">Logout</a></li>
      <?php } ?>
    </ul>
  </nav>
  <h1>What is My Private Stuff?</h1>
  <p>My Private Stuff is an web application built with PHP and MVC Architecture to help you manage your private stuff</p>
</header>