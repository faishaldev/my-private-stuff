<?php

class Dashboard extends Controller {
  public function index() {
    $data = [
      'title' => 'Dashboard',
      'amount_category' => $this->model('CategoriesModel')->getCategoryAmount(),
      'amount_stuff' => $this->model('StuffsModel')->getStuffAmount()
    ];

    $this->view('templates/header', $data);
    $this->view('dashboard/index', $data);
    $this->view('templates/footer');
  }
}