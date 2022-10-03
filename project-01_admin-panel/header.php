<?php 
  require_once(dirname(__FILE__) . './functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./mysql.png" type="image/x-icon">
  <title>Home</title>

  <!-- link bootsrap-5 css file -->
  <link rel="stylesheet" href="./assets/fw/bootstrap-5.2.0/css/bootstrap.min.css">

  <!-- link main stylesheet css file -->
  <link rel="stylesheet" href="style.css">

</head>

<body class="bg-light">

  <header>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
      <div class="container">

        <a class="navbar-brand" href="index.html">MySQL & AJAX</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#main-menu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div id="main-menu" class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="./admin.php">Show users</a></li>
            <li class="nav-item"><a class="nav-link" href="./update.php">Update users</a></li>
            <li class="nav-item"><a class="nav-link" href="./index.php">Sign in</a></li>
            <li class="nav-item"><a class="nav-link" href="./registration.php">Sign up</a></li>
            <li class="nav-item"><a class="nav-link" href="./logout.php">Logout</a></li>
          </ul>
        </div>

      </div>
    </nav>
  </header>