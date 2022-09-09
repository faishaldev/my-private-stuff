<?php

class Controller {
  public function view($view, $data = []) {
    if (!isset($_SESSION)) {
      session_start();
    }

    if (isset($_SESSION['username'])) {
      require_once '../src/views/' . $view . '.php';
    } else {
      require_once '../src/views/users/login.php';
    }
  }

  public function model($model) {
    require_once '../src/models/' . $model . '.php';

    return new $model;
  }
}