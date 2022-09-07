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
    if ($this->model('UsersModel')->addUser($_POST) > 0) {
      header('Location: ' . BASEURL . '/users');
      exit;
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

  public function register() {
    $data = [
      'title' => 'Register'
    ];

    $this->view('templates/header', $data);
    $this->view('users/register');
    $this->view('templates/footer');
  }
}