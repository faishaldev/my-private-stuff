<?php

class Logout extends Controller {
  public function index() {
    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    session_start();
    unset($_SESSION['username']);
    Flasher::setFlash('You have been logged out!');
    header('Location: ' . BASEURL);
  }
}