<?php

class Categories extends Controller {
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
      'title' => 'Categories',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];
    
    if ($data['role'] === 'Admin') {
      $data += [
        'categories' => $this->model('CategoriesModel')->getCategories()
      ];

      $this->view('templates/header', $data);
      $this->view('categories/index', $data);
      $this->view('templates/footer');
      exit;
    }

    if ($data['role'] === 'User') {
      $data += [
        'categories' => $this->model('CategoriesModel')->getCategoriesByUsername($_SESSION['username'])
      ];

      $this->view('templates/header', $data);
      $this->view('categories/index', $data);
      $this->view('templates/footer');
      exit;
    }
  }

  public function add() {
    $this->session();

    $data = [
      'title' => 'Add Category',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    $this->view('templates/header', $data);
    $this->view('categories/add', $data);
    $this->view('templates/footer');
  }

  public function create() {
    $userId = $this->model('UsersModel')->getUserIdByUsername($_POST['username']);

    if ($this->model('CategoriesModel')->addCategory($_POST, $userId)) {
      Flasher::setFlash('New category has been added!');
      header('Location: ' . BASEURL . '/categories');
      exit;
    }
  }

  public function edit($id) {
    $this->session();

    $data = [
      'title' => 'Edit Category',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
      'category' => $this->model('CategoriesModel')->getCategoryById($id)
    ];

    $this->view('templates/header', $data);
    $this->view('categories/edit', $data);
    $this->view('templates/footer');
  }

  public function update() {
    if($this->model('CategoriesModel')->updateCategory($_POST)) {
      Flasher::setFlash('Category has been updated!');
      header('Location: ' . BASEURL . '/categories');
      exit;
    }
  }

  public function delete($id) {
    if ($this->model('StuffsModel')->getStuffsAmountByCategoryId($id)) {
      Flasher::setFlash("Can't delete, there are stuff with this category!");
      header('Location: ' . BASEURL . '/categories');
      exit;
    }

    if ($this->model('CategoriesModel')->deleteCategory($id)) {
      Flasher::setFlash('Category has been deleted!');
      header('Location: ' . BASEURL . '/categories');
      exit;
    }
  }
}