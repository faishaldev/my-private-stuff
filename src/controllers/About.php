<?php

class About extends Controller {
  public function index() {
    if (!isset($_SESSION)) { 
      session_start();
    }
    $username = $_SESSION['username'];

    $data = [
      'title' => 'About',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($username)
    ];

    $this->view('templates/header', $data);
    $this->view('about/index', $data);
    $this->view('templates/footer');
  }
}