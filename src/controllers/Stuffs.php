<?php

class Stuffs extends Controller {
  public function index() {
    $data = [
      'title' => 'Stuffs',
      'stuffs' => $this->model('StuffsModel')->getStuffs()
    ];

    $this->view('templates/header', $data);
    $this->view('stuffs/index', $data);
    $this->view('templates/footer');
  }

  public function add() {
    $data = [
      'title' => 'Add Stuff',
      'categories' => $this->model('CategoriesModel')->getCategories()
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
    $data = [
      'title' => 'Edit Stuff',
      'stuff' => $this->model('StuffsModel')->getStuffById($id),
      'categories' => $this->model('CategoriesModel')->getCategories()
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