<?php

  require_once('functions.php');

  function log_in_user($user) {
    session_start();
    session_regenerate_id();
    $_SESSION['id'] = $user['id'];
    $_SESSION['userLevel'] = $user['userLevel'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['surname'] = $user['surname'];
    return true;
  }

  function is_logged_in() {
    return isset($_SESSION['id']);
  }

  function require_login() {
    if(!is_logged_in()) {
      redirect_to(url_for('/user_login.php'));
    }
  }
?>
