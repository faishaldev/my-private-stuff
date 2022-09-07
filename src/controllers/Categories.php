<?php

class Categories extends Controller {
  public function index() {
    $data = [
      'title' => 'Categories',
      'categories' => $this->model('CategoriesModel')->getCategories()
    ];
    
    $this->view('templates/header', $data);
    $this->view('categories/index', $data);
    $this->view('templates/footer');
  }

  public function add() {
    $data = [
      'title' => 'Add Category'
    ];

    $this->view('templates/header', $data);
    $this->view('categories/add');
    $this->view('templates/footer');
  }

  public function create() {
    if ($this->model('CategoriesModel')->addCategory($_POST) > 0) {
      header('Location: ' . BASEURL . '/categories');
      exit;
    }
  }

  public function edit($id) {
    $data = [
      'title' => 'Edit Category',
      'category' => $this->model('CategoriesModel')->getCategoryById($id)
    ];

    $this->view('templates/header', $data);
    $this->view('categories/edit', $data);
    $this->view('templates/footer');
  }

  public function update() {
    if($this->model('CategoriesModel')->editUser($_POST) > 0) {
      header('Location: ' . BASEURL . '/categories');
      exit;
    }
  }

  public function delete($id) {
    if ($this->model('CategoriesModel')->deleteUser($id) > 0) {
      header('Location: ' . BASEURL . '/categories');
      exit;
    }
  }
}