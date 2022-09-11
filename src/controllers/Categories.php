<?php

class Categories extends Controller {
  public function index() {
    if (!isset($_SESSION)) { 
      session_start();
    }

    $username = $_SESSION['username'];

    $data = [
      'title' => 'Categories',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($username)
    ];
    
    if ($data['role'] === 'Admin') {
      $data += ['categories' => $this->model('CategoriesModel')->getCategories()];

      $this->view('templates/header', $data);
      $this->view('categories/index', $data);
      $this->view('templates/footer');
      exit;
    }

    if ($data['role'] === 'User') {
      $data += ['categories' => $this->model('CategoriesModel')->getCategoriesByUsername($username)];

      $this->view('templates/header', $data);
      $this->view('categories/index', $data);
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
      'title' => 'Add Category',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($username)
    ];

    $this->view('templates/header', $data);
    $this->view('categories/add', $data);
    $this->view('templates/footer');
  }

  public function create() {
    $userId = $this->model('UsersModel')->getUserIdByUsername($_POST['username']);

    if ($this->model('CategoriesModel')->addCategory($_POST, $userId) > 0) {
      Flasher::setFlash('New category has been added!');
      header('Location: ' . BASEURL . '/categories');
      exit;
    }
  }

  public function edit($id) {
    if (!isset($_SESSION)) { 
      session_start();
    }

    $username = $_SESSION['username'];

    $data = [
      'title' => 'Edit Category',
      'category' => $this->model('CategoriesModel')->getCategoryById($id),
      'role' => $this->model('UsersModel')->getRoleNameByUsername($username)
    ];

    $this->view('templates/header', $data);
    $this->view('categories/edit', $data);
    $this->view('templates/footer');
  }

  public function update() {
    if($this->model('CategoriesModel')->editUser($_POST) > 0) {
      Flasher::setFlash('Category has been updated!');
      header('Location: ' . BASEURL . '/categories');
      exit;
    }
  }

  public function delete($id) {
    if ($this->model('StuffsModel')->getStuffAmountByCategoryId($id) > 0) {
      Flasher::setFlash('Cannot delete, there are stuff with this category!');
      header('Location: ' . BASEURL . '/categories');
      exit;
    }

    if ($this->model('CategoriesModel')->deleteCategory($id) > 0) {
      Flasher::setFlash('Category has been deleted!');
      header('Location: ' . BASEURL . '/categories');
      exit;
    }
  }
}