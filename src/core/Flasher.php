<?php

class Flasher {
  public static function setFlash($msg) {
    $_SESSION['flash'] = [
      'msg' => $msg
    ];
  }

  public static function flash() {
    if (isset($_SESSION['flash'])) {
      echo '<p>' . $_SESSION['flash']['msg'] . '</p>';

      unset($_SESSION['flash']);
    }
  }
}