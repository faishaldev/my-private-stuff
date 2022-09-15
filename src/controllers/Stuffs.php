<?php

class Stuffs extends Controller {
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
      'title' => 'Stuffs',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'Admin') {
      $data += [
        'stuffs' => $this->model('StuffsModel')->getStuffs()
      ];

      $this->view('templates/header', $data);
      $this->view('stuffs/index', $data);
      $this->view('templates/footer');
      exit;
    }
    
    if ($data['role'] === 'User') {
      $data += [
        'stuffs' => $this->model('StuffsModel')->getStuffsByUsername($_SESSION['username'])
      ];

      $this->view('templates/header', $data);
      $this->view('stuffs/index', $data);
      $this->view('templates/footer');
      exit;
    }
  }

  public function add() {
    $this->session();

    $data = [
      'title' => 'Add Stuff',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'Admin') {
      $data += [
        'categories' => $this->model('CategoriesModel')->getCategories()
      ];
    }

    if ($data['role'] === 'User') {
      $data += [
        'categories' => $this->model('CategoriesModel')->getCategoriesByUsername($_SESSION['username'])
      ];
    }

    $this->view('templates/header', $data);
    $this->view('stuffs/add', $data);
    $this->view('templates/footer');
  }

  public function create() {
    if ($this->model('StuffsModel')->addStuff($_POST)) {
      Flasher::setFlash('New stuff has been added!');
      header('Location: ' . BASEURL . '/stuffs');
      exit;
    }
  }

  public function edit($id) {
    $this->session();

    $data = [
      'title' => 'Edit Stuff',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
      'stuff' => $this->model('StuffsModel')->getStuffById($id),
      'categories' => $this->model('CategoriesModel')->getCategories()
    ];

    $this->view('templates/header', $data);
    $this->view('stuffs/edit', $data);
    $this->view('templates/footer');
  }

  public function update() {
    if ($this->model('StuffsModel')->updateStuff($_POST)) {
      Flasher::setFlash('Stuff has been updated!');
      header('Location: ' . BASEURL . '/stuffs');
      exit;
    }
  }

  public function delete($id) {
    if ($this->model('StuffsModel')->deleteStuff($id)) {
      Flasher::setFlash('Stuff has been deleted!');
      header('Location: '. BASEURL . '/stuffs');
      exit;
    }
  }
}