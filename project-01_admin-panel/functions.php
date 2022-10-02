<?php

// database configuration file including
if (file_exists(dirname(__FILE__) . './config.php')) {
  require_once(dirname(__FILE__) . './config.php');
}

// create test input function
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function user_logged_in() {

  if (isset($_SESSION['login_success']) || isset($_COOKIE['keep'])) {
    return true;
  } else {
    return false;
  }
  
}
