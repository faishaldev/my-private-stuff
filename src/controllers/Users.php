<?php

class Users extends Controller {
  public function index() {
    if (!isset($_SESSION)) { 
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Users',
      'users' => $this->model('UsersModel')->getUsers(),
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'Admin') {
      $this->view('templates/header', $data);
      $this->view('users/index', $data);
      $this->view('templates/footer');
      exit;
    }

    header('Location: ' . BASEURL . '/dashboard');
  }

  public function add() {
    if (!isset($_SESSION)) { 
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Add User',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'Users') {
      header('Location: ' . BASEURL . '/dashboard');
      exit;
    }

    $this->view('templates/header', $data);
    $this->view('users/add', $data);
    $this->view('templates/footer');
  }

  public function create() {
    if (!isset($_SESSION)) { 
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'User') {
      header('Location: ' . BASEURL . '/dashboard');
      exit;
    }

    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($this->model('UsersModel')->getUserAmountByUsernameOrEmail($_POST['username'], $_POST['email']) > 0) {
      Flasher::setFlash('Username/email has been used');
      header('Location: ' . BASEURL . '/users/add');
      exit;
    }

    if ($this->model('UsersModel')->addUser($_POST) > 0) {
      Flasher::setFlash('New user has been created!');
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function activate($id) {
    if (!isset($_SESSION)) { 
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'User') {
      header('Location: ' . BASEURL . '/dashboard');
    }

    if ($this->model('UsersModel')->activateUser($id) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function deactivate($id) {
    if (!isset($_SESSION)) { 
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'User') {
      header('Location: ' . BASEURL . '/dashboard');
    }

    if ($this->model('UsersModel')->deactivateUser($id) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function edit($id) {
    if (!isset($_SESSION)) { 
      session_start();
    }
    
    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Edit User',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
      'user' => $this->model('UsersModel')->getUserById($id)
    ];

    $this->view('templates/header', $data);
    $this->view('users/edit', $data);
    $this->view('templates/footer');
  }

  public function update() {
    if (!isset($_SESSION)) { 
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
      'user' => $this->model('UsersModel')->getUserById($_POST['id'])
    ];

    if ($data['role'] === 'User') {
      header('Location: ' . BASEURL . '/dashboard');
      exit;
    }

    if ($this->model('UsersModel')->getUserAmountByUsername($_POST['username']) > 0) {
      if ($_POST['username'] !== $data['user']['username']) {
        Flasher::setFlash('Username has been used!');
        header('Location: ' . BASEURL . '/users/edit/' . $_POST['id']);
        exit;
      }
    }

    if ($this->model('UsersModel')->getUserAmountByEmail($_POST['email'])) {
      if ($_POST['email'] !== $data['user']['email']) {
        Flasher::setFlash('Email has been used!');
        header('Location: ' . BASEURL . '/users/edit/' . $_POST['id']);
        exit;
      }
    }

    if ($this->model('UsersModel')->updateUser($_POST) > 0) {
      Flasher::setFlash('User has been updated!');
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function delete($id) {
    if (!isset($_SESSION)) { 
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'User') {
      header('Location: ' . BASEURL . '/dashboard');
    }

    if ($this->model('UsersModel')->deleteUser($id) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function recovery($id) {
    if (!isset($_SESSION)) { 
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'User') {
      header('Location: ' . BASEURL . '/dashboard');
    }

    if ($this->model('UsersModel')->recoverUser($id) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function login() {
    if (isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Login'
    ];

    $this->view('templates/header', $data);
    $this->view('users/login');
    $this->view('templates/footer');
  }

  public function signin() {
    if ($this->model('UsersModel')->getUserByUsernameOrEmailAndPassword($_POST['user'], $_POST['user']) > 0) {
      $userPasswordHashed = $this->model('UsersModel')->getPasswordByUsernameOrEmail($_POST['user']);

      if (password_verify($_POST['password'], $userPasswordHashed)) {
        $login = $this->model('UsersModel')->getUserByUsernameOrEmailAndPassword($_POST['user'], $userPasswordHashed);
        
        foreach ($login as $row) :
          if ($row['is_active']) {
            if ($row['is_deleted']) {
              Flasher::setFlash('Account has been deleted!');
              header('Location: ' . BASEURL);
              exit;
            }
  
            $_SESSION['username'] = $row['username'];
            header('Location: ' . BASEURL . '/dashboard');
            exit;
          }
  
          if (!$row['is_active']) {
            if ($row['is_deleted']) {
              Flasher::setFlash('Account has been deleted!');
              header('Location: ' . BASEURL);
              exit;
            }
            
            Flasher::setFlash('Account not activated yet!');
            header('Location: ' . BASEURL);
            exit;
          }
          
          header('Location: ' . BASEURL);
        endforeach;
      } else {
        Flasher::setFlash('Password is wrong!');
        header('Location: ' . BASEURL . '/?login=true');
        exit;
      }
    } else {
      Flasher::setFlash('Username/email not found!');
      header('Location: ' . BASEURL);
    }
  }

  public function logout() {
    session_start();
    unset($_SESSION['username']);
    session_destroy();
    header('Location: ' . BASEURL . '');
  }

  public function reset() {
    $data = [
      'title' => 'Reset Password'
    ];

    if (isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $this->view('templates/header', $data);
    $this->view('users/reset');
    $this->view('templtes/footer');
  }

  public function change() {
    $_POST['new_password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    if ($this->model('UsersModel')->getUserAmountByEmail($_POST['email']) > 0) {
      if ($this->model('UsersModel')->updateUserPassword($_POST) > 0) {
        Flasher::setFlash('Password has been updated!');
        header('Location: ' . BASEURL . '/?login=true');
        exit;
      }
    } else {
      Flasher::setFlash('Email not found!');
      header('Location: ' . BASEURL . '/?reset=true');
      exit;
    }
  }

  public function register() {
    if (isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Register'
    ];

    $this->view('templates/header', $data);
    $this->view('users/register');
    $this->view('templates/footer');
  }

  public function signup() {
    if ($this->model('UsersModel')->getUserAmountByUsername($_POST['username']) > 0) {
      Flasher::setFlash('Username has been used!');
      header('Location: ' . BASEURL . '/?register=true');
      exit;
    }

    if ($this->model('UsersModel')->getUserAmountByEmail($_POST['email'])) {
      Flasher::setFlash('Email has been used!');
      header('Location: ' . BASEURL . '/?register=true');
      exit;
    }

    if ($this->model('UsersModel')->addUser($_POST) > 0) {
      Flasher::setFlash('Account has been created! Check your email for activation!');
      header('Location: ' . BASEURL . '/?login=true');
      exit;
    }
  }
}