<?php

class Register extends Controller {
  public function index() {
    if (isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Register'
    ];

    $this->view('templates/header', $data);
    $this->view('register/index');
    $this->view('templates/footer');
  }

  public function user() {
    if ($this->model('UsersModel')->getUserAmountByUsername($_POST['username'])) {
      Flasher::setFlash('Username has been used!');
      header('Location: ' . BASEURL . '/?register=true');
      exit;
    }

    if ($this->model('UsersModel')->getUserAmountByEmail($_POST['email'])) {
      Flasher::setFlash('Email has been used!');
      header('Location: ' . BASEURL . '/?register=true');
      exit;
    }

    if ($this->model('UsersModel')->addUser($_POST)) {
      Flasher::setFlash('Account has been created! Check your email for activation!');
      header('Location: ' . BASEURL . '/?login=true');
      exit;
    }
  }
}