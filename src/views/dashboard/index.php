<?php include_once __DIR__ . '/../layouts/navbar.php' ?>

<h3>Categories: <?= $data['amount_category']; ?></h3>
<h3>Stuff: <?= $data['amount_stuff']; ?></h1>
<div><?php Flasher::flash(); ?></div>