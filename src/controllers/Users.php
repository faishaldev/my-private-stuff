<?php

class Users extends Controller {
  public function index() {
    $data = [
      'title' => 'Users',
      'users' => $this->model('UsersModel')->getUsers()
    ];

    $this->view('templates/header', $data);
    $this->view('users/index', $data);
    $this->view('templates/footer');
  }

  public function add() {
    $data = [
      'title' => 'Add User'
    ];

    $this->view('templates/header', $data);
    $this->view('users/add');
    $this->view('templates/footer');
  }

  public function create() {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($this->isUserAvailable($username, $email)) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }

    if ($this->model('UsersModel')->addUser($_POST) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function isUserAvailable($username, $email) {
    if ($this->model('UsersModel')->checkUserAvailability($username, $email) > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function activate($id) {
    if ($this->model('UsersModel')->activateUser($id) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function deactivate($id) {
    if ($this->model('UsersModel')->deactivateUser($id) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function edit($id) {
    $data = [
      'title' => 'Edit User',
      'user' => $this->model('UsersModel')->getUserById($id)
    ];

    $this->view('templates/header', $data);
    $this->view('users/edit', $data);
    $this->view('templates/footer');
  }

  public function update() {
    if ($this->model('UsersModel')->editUser($_POST) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function delete($id) {
    if ($this->model('UsersModel')->deleteUser($id) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function recovery($id) {
    if ($this->model('UsersModel')->recoveryUser($id) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function login() {
    $data = [
      'title' => 'Login'
    ];

    $this->view('templates/header', $data);
    $this->view('users/login');
    $this->view('templates/footer');
  }

  public function signin() {
    $user = $_POST['user'];
    $password = $_POST['password'];
    
    $data = [
      'login' => $this->model('UsersModel')->loginUser($user, $password)
    ];

    session_start();

    if ($data['login'] == NULL) {
      header('Location: ' . BASEURL . '/users/login');
    } else {
      foreach ($data['login'] as $row) :
        $_SESSION['username'] = $row['username'];
        header('Location: ' . BASEURL);
      endforeach;
    }
  }

  public function logout() {
    session_start();
    unset($_SESSION['username']);
    session_destroy();
    header('Location: ' . BASEURL . '');
  }

  public function register() {
    $data = [
      'title' => 'Register'
    ];

    $this->view('templates/header', $data);
    $this->view('users/register');
    $this->view('templates/footer');
  }
}