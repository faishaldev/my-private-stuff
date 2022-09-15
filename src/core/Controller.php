<?php

class Controller {
  public function view($view, $data = []) {
    if (!isset($_SESSION)) {
      session_start();
    }

    if (isset($_SESSION['username'])) {
      require_once '../src/views/' . $view . '.php';
    } else if (isset($_GET['forgot'])) {
      require_once '../src/views/users/forgot.php';
    } else if (isset($_GET['register'])) {
      require_once '../src/views/users/register.php';
    } else if (isset($_GET['login'])) {
      require_once '../src/views/users/login.php';
    } else if (isset($_GET['about'])) {
      require_once '../src/views/about/index.php';
    } else if (isset($_GET['reset']) && isset($_GET['id'])) {
      require_once '../src/views/users/reset.php';
    } else {
      require_once '../src/views/home/index.php';
    }
  }

  public function model($model) {
    require_once '../src/models/' . $model . '.php';

    return new $model;
  }
}