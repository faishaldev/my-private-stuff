<?php

class Controller {
  public function view($view, $data = []) {
    if (!isset($_SESSION)) {
      session_start();
    }

    if (isset($_SESSION['username'])) {
      require_once '../src/views/' . $view . '.php';
    } else if (isset($_GET['reset'])) {
      require_once '../src/views/users/reset.php';
    } else if (isset($_GET['register'])) {
      require_once '../src/views/users/register.php';
    } else if (isset($_GET['login'])) {
      require_once '../src/views/users/login.php';
    } else {
      require_once '../src/views/home/index.php';
    }
  }

  public function model($model) {
    require_once '../src/models/' . $model . '.php';

    return new $model;
  }
}