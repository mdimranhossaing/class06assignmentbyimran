<?php 

  session_start();
  session_destroy();

  if (isset($_COOKIE['keep'])) {
    unset($_COOKIE['keep']); 
    setcookie('keep', null, time() - (86400 * 1));
  }
  header('location: index.php');

?>