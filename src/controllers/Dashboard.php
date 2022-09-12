<?php

class Dashboard extends Controller {
  public function index() {
    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }
    
    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Dashboard',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'Admin') {
      $data += [
        'amount_category' => $this->model('CategoriesModel')->getCategoriesAmount(),
        'amount_stuff' => $this->model('StuffsModel')->getStuffsAmount()
      ];

      $this->view('templates/header', $data);
      $this->view('dashboard/index', $data);
      $this->view('templates/footer');
      exit;
    }

    if ($data['role'] === 'User') {
      $data += [
        'amount_category' => $this->model('CategoriesModel')->getCategoriesAmountByUsername($_SESSION['username']),
        'amount_stuff' => $this->model('StuffsModel')->getStuffsAmountByUsername($_SESSION['username'])
      ];

      $this->view('templates/header', $data);
      $this->view('dashboard/index', $data);
      $this->view('templates/footer');
      exit;
    }
  }
}