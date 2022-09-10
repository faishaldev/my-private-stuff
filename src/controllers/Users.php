<?php

class Users extends Controller {
  public function index() {
    $data = [
      'title' => 'Users',
      'users' => $this->model('UsersModel')->getUsers()
    ];

    if (!isset($_SESSION)) { 
      session_start();
    }
    
    $username = $_SESSION['username'];
    $role = $this->model('UsersModel')->getRoleNameByUsername($username);

    if ($role === 'Admin') {
      $this->view('templates/header', $data);
      $this->view('users/index', $data);
      $this->view('templates/footer');
      exit;
    }

    header('Location: ' . BASEURL);
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

    if (isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
    }

    $this->view('templates/header', $data);
    $this->view('users/login');
    $this->view('templates/footer');
  }

  public function signin() {
    $user = $_POST['user'];
    $password = $_POST['password'];

    if ($this->model('UsersModel')->checkUserAvailability($user, $user) > 0) {
      $userPasswordHashed = $this->model('UsersModel')->getPasswordByUsernameOrEmail($user);

      if (password_verify($password, $userPasswordHashed)) {
        $login = $this->model('UsersModel')->loginUser($user, $userPasswordHashed);
        
        foreach ($login as $row) :
          if ($row['is_active']) {
            if ($row['is_deleted']) {
              Flasher::setFlash('Akun telah dihapus!');
              header('Location: ' . BASEURL);
              exit;
            }
  
            $_SESSION['username'] = $row['username'];
            header('Location: ' . BASEURL . '/dashboard');
            exit;
          }
  
          if (!$row['is_active']) {
            if ($row['is_deleted']) {
              Flasher::setFlash('Akun telah dihapus!');
              header('Location: ' . BASEURL);
              exit;
            }
            
            Flasher::setFlash('Akun belum diaktivasi!');
            header('Location: ' . BASEURL);
            exit;
          }
          
          header('Location: ' . BASEURL);
        endforeach;
      } else {
        Flasher::setFlash('Password salah!');
        header('Location: ' . BASEURL);
        exit;
      }
    } else {
      Flasher::setFlash('Username/email tidak ditemukan!');
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
    }

    $this->view('templates/header', $data);
    $this->view('users/reset');
    $this->view('templtes/footer');
  }

  public function password() {
    
  }

  public function register() {
    $data = [
      'title' => 'Register'
    ];

    if (isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
    }

    $this->view('templates/header', $data);
    $this->view('users/register');
    $this->view('templates/footer');
  }
}