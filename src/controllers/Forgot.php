<?php

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Forgot extends Controller {
  public function index() {
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
}