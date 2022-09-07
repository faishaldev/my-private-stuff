<?php

class Stuffs extends Controller {
  public function index() {
    $data = [
      'title' => 'Stuffs'
    ];

    $this->view('templates/header', $data);
    $this->view('stuffs/index');
    $this->view('templates/footer');
  }
}