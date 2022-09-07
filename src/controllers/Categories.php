<?php

class Categories extends Controller {
  public function index() {
    $data = [
      'title' => 'Categories'
    ];
    
    $this->view('templates/header', $data);
    $this->view('categories/index');
    $this->view('templates/footer');
  }
}