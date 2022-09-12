<?php

class Profile extends Controller {
  public function index() {
    if (!isset($_SESSION)) {
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Profile',
    ];

    $data += [
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
      'user' => $this->model('UsersModel')->getUserInfoByUsername($_SESSION['username'])
    ];

    $this->view('templates/header', $data);
    $this->view('profile/index', $data);
    $this->view('templates/footer');
  }

  public function edit() {
    if (!isset($_SESSION)) {
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Edit Profile',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
      'user' => $this->model('UsersModel')->getUserInfoByUsername($_SESSION['username'])
    ];

    $this->view('templates/header', $data);
    $this->view('profile/edit', $data);
    $this->view('templates/footer');
  }

  public function update() {
    if ($this->model('UsersModel')->editProfile($_POST) > 0) {
      header('Location: ' . BASEURL . '/profile');
      exit;
    }
  }

  public function change() {
    if (!isset($_SESSION)) {
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Change Password',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
    ];

    $this->view('templates/header', $data);
    $this->view('profile/change', $data);
    $this->view('templates/footer');
  }
}