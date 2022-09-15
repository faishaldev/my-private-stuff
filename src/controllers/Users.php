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

  public function login() {
    if (isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Login'
    ];

    $this->view('templates/header', $data);
    $this->view('users/login');
    $this->view('templates/footer');
  }

  public function signin() {
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

  public function logout() {
    session_start();
    unset($_SESSION['username']);
    Flasher::setFlash('You have been logged out!');
    header('Location: ' . BASEURL);
  }

  public function forgot() {
    if (isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Forgot Password'
    ];

    $this->view('templates/header', $data);
    $this->view('users/forgot');
    $this->view('templtes/footer');
  }

  public function password() {
    if ($this->model('UsersModel')->checkEmailAvailability($_POST['email'])) {
      $fullName = $this->model('UsersModel')->getFullnameById($_POST['email']);
      $userId = $this->model('UsersModel')->getUserIdByEmail($_POST['email']);

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
        $mail->addAddress($_POST['email'], $fullName);

        $mail->isHTML(true);
        $mail->Subject = "Email Reset Password for My Private Stuff Account";
        $mail->Body = "Here the link for reset your account password: \n" . BASEURL . '/?reset=true&id=' . $userId;

        $mail->send();

        Flasher::setFlash('Email to reset password has been sent!');
        header('Location: ' . BASEURL . '/?forgot=true');
        exit;
      } catch (Exception $err) {
        Flasher::setFlash('Email not sent: ' . $mail->ErrorInfo);
        header('Location: ' . BASEURL . '/?forgot=true');
        exit;
      }
    }

    Flasher::setFlash('Email not found!');
    header('Location: ' . BASEURL . '/?forgot=true');
    exit;
  }

  public function reset() {
    $data = [
      'title' => "Reset Password",
    ];
    
    $this->view('templates/header', $data);
    $this->view('users/reset', $data);
    $this->view('templates/footer');
  }

  public function change() {
    if ($_POST['new_password'] !== $_POST['verify_new_password']) {
      Flasher::setFlash('Please check your new password and retype the new password correctly!');
      header('Location: ' . BASEURL . '?reset=true&id=' . $_GET['id']);
      exit;
    }

    $_POST['new_password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    if ($this->model('UsersModel')->updateUserPassword($_POST) > 0) {
      Flasher::setFlash('Password has been updated!');
      header('Location: ' . BASEURL . '/?login=true');
      exit;
    }
  }

  public function register() {
    if (isset($_SESSION['username'])) {
      header('Location: ' . BASEURL);
      exit;
    }

    $data = [
      'title' => 'Register'
    ];

    $this->view('templates/header', $data);
    $this->view('users/register');
    $this->view('templates/footer');
  }

  public function signup() {
    if ($this->model('UsersModel')->getUserAmountByUsername($_POST['username'])) {
      Flasher::setFlash('Username has been used!');
      header('Location: ' . BASEURL . '/?register=true');
      exit;
    }

    if ($this->model('UsersModel')->getUserAmountByEmail($_POST['email'])) {
      Flasher::setFlash('Email has been used!');
      header('Location: ' . BASEURL . '/?register=true');
      exit;
    }

    if ($this->model('UsersModel')->addUser($_POST)) {
      Flasher::setFlash('Account has been created! Check your email for activation!');
      header('Location: ' . BASEURL . '/?login=true');
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
      $mail->Body = "Here the link for activate your account: \n" . BASEURL . "/users/activation/" . $id;

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