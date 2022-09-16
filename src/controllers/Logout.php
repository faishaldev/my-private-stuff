<?php

class Logout extends Controller {
  public function index() {
    session_start();
    unset($_SESSION['username']);
    Flasher::setFlash('You have been logged out!');
    header('Location: ' . BASEURL);
  }
}