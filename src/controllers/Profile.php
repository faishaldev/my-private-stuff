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
    if ($this->model('UsersModel')->getUserAmountByUsername($_POST['username'])) {
      if ($_POST['username'] !== $_SESSION['username']) {
        Flasher::setFlash('Username has been used!');
        header('Location: ' . BASEURL . '/profile/edit/' . $_POST['id']);
        exit;
      }
    }

    $email = $this->model('UsersModel')->getUserEmailByUsername($_SESSION['username']);

    if ($this->model('UsersModel')->getUserAmountByEmail($_POST['email'])) {
      if ($_POST['email'] !== $email) {
        Flasher::setFlash('Email has been used!');
        header('Location: ' . BASEURL . '/profile/edit/' . $_POST['id']);
        exit;
      }
    }

    if ($this->model('UsersModel')->updateUserProfile($_POST) > 0) {
      Flasher::setFlash('Profile has been updated!');
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

  public function password() {
    $userPassword = $this->model('UsersModel')->getPasswordByUsernameOrEmail($_SESSION['username']);

    if (password_verify($_POST['old_password'], $userPassword)) {
      var_dump($_POST['old_password'], $userPassword);
      $hashedNewPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

      if ($this->model('UsersModel')->changeUserPasswordByUsername($hashedNewPassword, $_SESSION['username'])) {
        Flasher::setFlash('Password has been changed!');
        header('Location: ' . BASEURL . '/profile');
        exit;
      }
    }

    Flasher::setFlash('Old password not match!');
    header('Location: ' . BASEURL . '/profile/change');
    exit;
  }
}