<?php

class Dashboard extends Controller {
  public function index() {
    $username = $_SESSION['username'];

    $data = [
      'title' => 'Dashboard',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($username)
    ];

    if ($data['role'] === 'Admin') {
      $data += [
        'amount_category' => $this->model('CategoriesModel')->getCategoryAmount(),
        'amount_stuff' => $this->model('StuffsModel')->getStuffAmount()
      ];

      $this->view('templates/header', $data);
      $this->view('dashboard/index', $data);
      $this->view('templates/footer');
      exit;
    }

    if ($data['role'] === 'User') {
      $data += [
        'amount_category' => $this->model('CategoriesModel')->getCategoryAmountByUsername($username),
        'amount_stuff' => $this->model('StuffsModel')->getStuffAmountByUsername($username)
      ];

      $this->view('templates/header', $data);
      $this->view('dashboard/index', $data);
      $this->view('templates/footer');
      exit;
    }
  }
}