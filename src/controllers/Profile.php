<?php

class Profile extends Controller {
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
      'title' => 'Profile',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
      'user' => $this->model('UsersModel')->getUserByUsername($_SESSION['username'])
    ];

    $this->view('templates/header', $data);
    $this->view('profile/index', $data);
    $this->view('templates/footer');
  }

  public function edit() {
    $this->session();

    $data = [
      'title' => 'Edit Profile',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
      'user' => $this->model('UsersModel')->getUserByUsername($_SESSION['username'])
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

    if ($this->model('UsersModel')->getUserAmountByEmail($_POST['email'])) {
      $email = $this->model('UsersModel')->getUserEmailByUsername($_SESSION['username']);

      if ($_POST['email'] !== $email) {
        Flasher::setFlash('Email has been used!');
        header('Location: ' . BASEURL . '/profile/edit/' . $_POST['id']);
        exit;
      }
    }

    if ($this->model('UsersModel')->updateUserProfile($_POST)) {
      Flasher::setFlash('Profile has been updated!');
      header('Location: ' . BASEURL . '/profile');
      exit;
    }
  }

  public function change() {
    $this->session();

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
      if ($_POST['new_password'] === $_POST['old_password'] ) {
        Flasher::setFlash('Password has been used by yourself!');
        header('Location: ' . BASEURL . '/profile/change');
        exit;
      }

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

  public function delete($id) {
    $role = $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']);

    if ($role === 'Admin') {
      header('Location: ' . BASEURL . '/profile');
      exit;
    }

    if ($this->model('UsersModel')->deleteUser($id)) {
      session_start();
      unset($_SESSION['username']);
      Flasher::setFlash('Your account has been deleted!');
      header('Location: ' . BASEURL);
      exit;
    }
  }
}