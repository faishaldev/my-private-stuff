<?php

class Login extends Controller {
  public function index() {
    if (isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Login'
    ];

    $this->view('templates/header', $data);
    $this->view('login/index');
    $this->view('templates/footer');
  }

  
  public function user() {
    if ($this->model('UsersModel')->getUserAmountByUsernameOrEmail($_POST['user'], $_POST['user']) > 0) {
      $userPasswordHashed = $this->model('UsersModel')->getPasswordByUsernameOrEmail($_POST['user']);

      if (password_verify($_POST['password'], $userPasswordHashed)) {
        $login = $this->model('UsersModel')->getUserByUsernameOrEmailAndPassword($_POST['user'], $userPasswordHashed);
        
        foreach ($login as $row) :
          if ($row['is_active']) {
            if ($row['is_deleted']) {
              Flasher::setFlash('Account has been deleted!');
              header('Location: ' . BASEURL);
              exit;
            }
  
            $_SESSION['username'] = $row['username'];
            
            if ($this->model('UsersModel')->lastLogin($_SESSION['username'])) {
              Flasher::setFlash('You are now login!');
              header('Location: ' . BASEURL . '/dashboard');
              exit;
            }
          }
  
          if (!$row['is_active']) {
            if ($row['is_deleted']) {
              Flasher::setFlash('Account has been deleted!');
              header('Location: ' . BASEURL);
              exit;
            }
            
            Flasher::setFlash('Account not activated yet!');
            header('Location: ' . BASEURL . '/?login=true');
            exit;
          }
          
          header('Location: ' . BASEURL);
        endforeach;
      } else {
        Flasher::setFlash('Password is wrong!');
        header('Location: ' . BASEURL . '/?login=true');
        exit;
      }
    }

    Flasher::setFlash('Username/email not found!');
    header('Location: ' . BASEURL . '/?login=true');
    exit;
  }
}