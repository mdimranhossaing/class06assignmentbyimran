<?php

// session start
session_start();

// functions file including
if (file_exists(dirname(__FILE__) . './functions.php')) {
  require_once(dirname(__FILE__) . './functions.php');

  if (user_logged_in()) {
    header('location: admin.php');
  }
}

// registration process
if (isset($_REQUEST['signup'])) {

  // define variables and set the empty value
  $username = $email = $password = $con_password = null;
  $error = array();

  // create variables
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $con_password = test_input($_POST['con_password']);
  }

  // form validations

  if (empty($username)) { // username
    $error['username'] = 'Username is required.';
  } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
    $error['username'] = 'Only letters and white space allowed.';
  }

  // check already us this email
  $sql = "SELECT `email` FROM `users` WHERE `email` = '$email'";
  $query = mysqli_query($connection, $sql) or mysqli_error($connection);

  if (empty($email)) { // email
    $error['email'] = 'Email is required.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = 'Invalid email format.';
  } elseif (mysqli_num_rows($query)) {
    $error['email'] = 'This email is already being used.';
  }

  // regular expetions
  $number = preg_match('@[0-9]@', $password);
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $specialChars = preg_match('@[^\w]@', $password);

  if (empty($password)) { // password
    $error['password'] = 'Password is required.';
  } elseif (strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
    $error['password'] = 'Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.';
  }

  if (empty($con_password)) { // confirm password
    $error['con_password'] = 'Confirm password is required.';
  } elseif ($password !== $con_password && !empty($password)) {
    $error['con_password'] = 'Password is not match';
  } elseif ($password === $con_password) { // password checking & solting
    $solt_password = md5($con_password);
  }

  // genarated unique user id
  $user_id = rand(10, 100) . rand(100, 1000);

  // insert data on database table
  if (count($error) == 0) {

    // create sql
    $sql = "INSERT INTO `users`(`user_id`, `username`, `email`, `password`) VALUES ('$user_id', '$username', '$email', '$solt_password')";

    // create query
    if ($connection->query($sql) === true) {

      // $_SESSION['registration_success'] = 'Thank you for registration';
      header('location: admin.php');
    } else {
      $message = 'Error: ' . $sql . "<br>" . $connection->error . '';
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>App</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="registration">
  <div class="inner-box">

    <h2 class="title">sign up</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

      <div class="field">
        <input class="input-field" type="text" name="username" placeholder="Enter your username">
        <?php
        if (isset($error["username"])) {
          echo '<div class="error">' . $error["username"] . '</div>';
        }
        ?>

      </div>

      <div class="field">
        <input class="input-field" type="email" name="email" placeholder="Enter your email">
        <?php
        if (isset($error["email"])) {
          echo '<div class="error">' . $error["email"] . '</div>';
        }
        ?>
      </div>

      <div class="field">
        <input class="input-field" type="password" name="password" placeholder="Enter new password">
        <?php
        if (isset($error["password"])) {
          echo '<div class="error">' . $error["password"] . '</div>';
        }
        ?>
      </div>

      <div class="field">
        <input class="input-field" type="password" name="con_password" placeholder="Enter confirm password">
        <?php
        if (isset($error["con_password"])) {
          echo '<div class="error">' . $error["con_password"] . '</div>';
        }
        ?>
      </div>


      <div class="links">

        <div class="form-check">
          <input type="checkbox" name="keep" id="keep" checked>
          <label for="keep">By signign up you accept the <a href="#">Term of service</a> and <a href="#">Privecy policy</a></label>
        </div>

      </div>

      <input type="submit" name="signup" value="sign up">
    </form>

    <div class="another-link">
      <span>already have an account?</span>
      <a href="./index.php">sign in</a>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script src="./assets/js/scripts.js"></script>

</body>

</html>