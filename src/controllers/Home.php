<?php

class Home extends Controller {
  public function index() {
    if (!isset($_SESSION)) { 
      session_start();
    }

    $data = [
      'title' => 'Home'
    ];

    if (isset($_SESSION['username'])) {
      $data += [
        'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
      ];
    }

    $this->view('templates/header', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer');
  }
}