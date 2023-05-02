<?php

$mode = $_GET['mode'];

switch ($mode) {
  case 'login':
    login();
    break;
}

function login() {
  $token = $_POST['token'];
  
}

?>