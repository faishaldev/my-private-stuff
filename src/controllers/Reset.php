<?php

class Reset extends Controller {
  public function index() {
    $data = [
      'title' => "Reset Password",
    ];
    
    $this->view('templates/header', $data);
    $this->view('users/reset', $data);
    $this->view('templates/footer');
  }

  public function password() {
    if ($_POST['new_password'] !== $_POST['verify_new_password']) {
      Flasher::setFlash('Please check your new password and retype the new password correctly!');
      header('Location: ' . BASEURL . '?reset=true&id=' . $_POST['id']);
      exit;
    }

    $_POST['new_password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    if ($this->model('UsersModel')->updateUserPassword($_POST)) {
      Flasher::setFlash('Password has been updated!');
      header('Location: ' . BASEURL . '/?login=true');
      exit;
    }
  }
}