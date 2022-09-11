<?php

class Stuffs extends Controller {
  public function index() {
    if (!isset($_SESSION)) { 
      session_start();
    }

    $username = $_SESSION['username'];
    
    $data = [
      'title' => 'Stuffs',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($username)
    ];

    if ($data['role'] === 'Admin') {
      $data += ['stuffs' => $this->model('StuffsModel')->getStuffs()];

      $this->view('templates/header', $data);
      $this->view('stuffs/index', $data);
      $this->view('templates/footer');
      exit;
    }
    
    if ($data['role'] === 'User') {
      $data += ['stuffs' => $this->model('StuffsModel')->getStuffsByUsername($username)];

      $this->view('templates/header', $data);
      $this->view('stuffs/index', $data);
      $this->view('templates/footer');
      exit;
    }
  }

  public function add() {
    if (!isset($_SESSION)) { 
      session_start();
    }

    $username = $_SESSION['username'];

    $data = [
      'title' => 'Add Stuff',
      'categories' => $this->model('CategoriesModel')->getCategories(),
      'role' => $this->model('UsersModel')->getRoleNameByUsername($username)
    ];

    $this->view('templates/header', $data);
    $this->view('stuffs/add', $data);
    $this->view('templates/footer');
  }

  public function create() {
    if ($this->model('StuffsModel')->addStuff($_POST) > 0) {
      header('Location: ' . BASEURL . '/stuffs');
      exit;
    }
  }

  public function edit($id) {
    if (!isset($_SESSION)) { 
      session_start();
    }

    $username = $_SESSION['username'];

    $data = [
      'title' => 'Edit Stuff',
      'stuff' => $this->model('StuffsModel')->getStuffById($id),
      'categories' => $this->model('CategoriesModel')->getCategories(),
      'role' => $this->model('UsersModel')->getRoleNameByUsername($username)
    ];

    $this->view('templates/header', $data);
    $this->view('stuffs/edit', $data);
    $this->view('templates/footer');
  }

  public function update() {
    if ($this->model('StuffsModel')->editUser($_POST) > 0) {
      header('Location: ' . BASEURL . '/stuffs');
      exit;
    }
  }

  public function delete($id) {
    if ($this->model('StuffsModel')->deleteStuff($id) > 0) {
      header('Location: '. BASEURL . '/stuffs');
      exit;
    }
  }
}