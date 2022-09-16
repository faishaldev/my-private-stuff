<?php

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Users extends Controller {
  public function session() {
    if (!isset($_SESSION)) { 
      session_start();
    }

    if (!isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }
  }

  public function index() {
    $this->session();

    $data = [
      'title' => 'Users',
      'users' => $this->model('UsersModel')->getUsers(),
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'Admin') {
      $this->view('templates/header', $data);
      $this->view('users/index', $data);
      $this->view('templates/footer');
      exit;
    }

    header('Location: ' . BASEURL . '/dashboard');
  }

  public function add() {
    $this->session();

    $data = [
      'title' => 'Add User',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username'])
    ];

    if ($data['role'] === 'Users') {
      header('Location: ' . BASEURL . '/dashboard');
      exit;
    }

    $this->view('templates/header', $data);
    $this->view('users/add', $data);
    $this->view('templates/footer');
  }

  public function create() {
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($this->model('UsersModel')->getUserAmountByUsername($_POST['username'])) {
      Flasher::setFlash('Username has been used');
      header('Location: ' . BASEURL . '/users/add');
      exit;
    }

    if ($this->model('UsersModel')->getUserAmountByEmail($_POST['email'])) {
      Flasher::setFlash('Email has been used');
      header('Location: ' . BASEURL . '/users/add');
      exit;
    }

    if ($this->model('UsersModel')->addUser($_POST)) {
      Flasher::setFlash('New user has been created!');
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function activate($id) {
    if ($this->model('UsersModel')->activateUser($id)) {
      Flasher::setFlash('User account has been activated!');
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function deactivate($id) {
    if ($this->model('UsersModel')->deactivateUser($id)) {
      Flasher::setFlash('User account has been deactivated!');
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function edit($id) {
    $this->session();

    $data = [
      'title' => 'Edit User',
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
      'user' => $this->model('UsersModel')->getUserById($id)
    ];

    $this->view('templates/header', $data);
    $this->view('users/edit', $data);
    $this->view('templates/footer');
  }

  public function update() {
    $data = [
      'role' => $this->model('UsersModel')->getRoleNameByUsername($_SESSION['username']),
      'user' => $this->model('UsersModel')->getUserById($_POST['id']),
    ];

    if ($this->model('UsersModel')->getUserAmountByUsername($_POST['username']) > 0) {
      if ($_POST['username'] !== $data['user']['username']) {
        Flasher::setFlash('Username has been used!');
        header('Location: ' . BASEURL . '/users/edit/' . $_POST['id']);
        exit;
      }
    }

    if ($this->model('UsersModel')->getUserAmountByEmail($_POST['email'])) {
      if ($_POST['email'] !== $data['user']['email']) {
        Flasher::setFlash('Email has been used!');
        header('Location: ' . BASEURL . '/users/edit/' . $_POST['id']);
        exit;
      }
    }

    if (!$this->model('UsersModel')->checkPassword($_POST['password'])) {
      $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    if ($this->model('UsersModel')->updateUser($_POST)) {
      Flasher::setFlash('User account has been updated!');
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function delete($id) {
    if ($this->model('UsersModel')->deleteUser($id)) {
      Flasher::setFlash('User account has been deleted!');
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function remove($id) {
    $this->model('StuffsModel')->deleteStuffsByUserId($id);
    $this->model('CategoriesModel')->deleteCategoriesByUserId($id);
    
    if ($this->model('UsersModel')->removeUser($id)) {
      Flasher::setFlash('User account has been removed from database!');
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function recovery($id) {
    if ($this->model('UsersModel')->recoverUser($id)) {
      Flasher::setFlash('User account has been recovered!');
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function send($id) {
    $email = $this->model('UsersModel')->getEmailById($id);
    $fullname = $this->model('UsersModel')->getFullnameById($id);

    $mail = new PHPMailer(true);

    try {
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();
      $mail->Host = SMTP_HOST;
      $mail->SMTPAuth = true;
      $mail->Username = USER_EMAIL;
      $mail->Password = USER_PASSWORD;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = SMTP_PORT;

      $mail->setFrom('myprivatestuff@mail.com', 'My Private Stuff');
      $mail->addAddress($email, $fullname);

      $mail->isHTML(true);
      $mail->Subject = "Email Activation for My Private Stuff Account";
      $mail->Body = "Here the link to activate your account: \n" . BASEURL . "/users/activation/" . $id;

      $mail->send();

      Flasher::setFlash('Email activation has been sent!');
      header('Location: ' . BASEURL . '/users');
      exit;
    } catch (Exception $err) {
      Flasher::setFlash('Email not sent caused of ' . $mail->ErrorInfo);
      header('Location: ' . BASEURL . '/users');
      exit;
    }
  }

  public function activation($id) {
    if ($this->model('UsersModel')->activateUser($id)) {
      Flasher::setFlash('Your account has been activated!');
      header('Location: ' . BASEURL . '/?login=true');
      exit;
    }
  }
}