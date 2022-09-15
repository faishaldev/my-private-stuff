<?php

class About extends Controller {
  public function session() {
    if (!isset($_SESSION)) { 
      session_start();
    }
    
    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }
  }

  public function index() {
    $this->session();
    
    $data = [
      'title' => 'About',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    $this->view('templates/header', $data);
    $this->view('about/index', $data);
    $this->view('templates/footer');
  }
}