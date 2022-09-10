<?php

class Home extends Controller {
  public function index() {
    $data = [
      'title' => 'Home'
    ];

    if (!isset($_SESSION)) { 
      session_start();
    }

    if (isset($_SESSION['username'])) {
      $username = $_SESSION['username'];

      $data += ['role' => $this->model('UsersModel')->getRoleNameByUsername($username)];
    }

    $this->view('templates/header', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer');
  }
}