<?php

session_start();

// require functions file
require_once(dirname(__FILE__) . './functions.php');

if (user_logged_in()) {
  header('location: admin.php');
}

// login prossec
if (isset($_REQUEST['login'])) {

  // create variables
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];

  $select_email = "SELECT email FROM users WHERE email = '$email'";
  $email_query = $connection->query($select_email);

  $select_password = "SELECT password FROM users WHERE email = '$email'";
  $password_query = $connection->query($select_password);

  if ( !empty($email)) { // emial is not empty
    if ($email_query->num_rows > 0) {
    
      if ( !empty($password) ) { // password is not empty
        while($row = $password_query->fetch_assoc()) {
          if (md5($password) == $row['password']) {
            $_SESSION['login_success'] = 'Thank you for login';
            if (isset($_REQUEST['keep'])) {
              setcookie('keep', 'keeped', time() + (86400 * 1));
            }
            header('location: admin.php');
          } else {
            $error['password'] = 'Password not match, Please insert currect password.';
          }
        }
      } else {
        $error['password'] = 'password field is required.';
      }
  
    } else {
      $error['email'] = 'Please insert currect email.';
    }
  } else { // email is empty
    $error['email'] = 'Email field is required.';
  }

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./mysql.png" type="image/x-icon">
  <title>Sign In</title>

  <!-- link bootsrap-5 css file -->
  <link rel="stylesheet" href="./assets/fw/bootstrap-5.2.0/css/bootstrap.min.css">

  <!-- link main stylesheet css file -->
  <link rel="stylesheet" href="style.css">

</head>

<body class="login">

  <div class="inner-box">

    <h2 class="title">sign in</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate>
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


      <div class="keep-and-link">
        <div class="keep">
          <input type="checkbox" name="keep" id="keep">
          <label for="keep">remember me</label>
        </div>

        <div class="link">
          <a href="#">forgot password?</a>
        </div>
      </div>

      <input type="submit" name="login" value="sign in">
    </form>

    <div class="or">or</div>

    <div class="social-buttons">
      <ul>
        <li><a><i class="bi bi-facebook"></i></a></li>
        <li><a><i class="bi bi-google"></i></a></li>
        <li><a><i class="bi bi-twitter"></i></a></li>
      </ul>
    </div>

    <div class="another-link">
      <span>don't have an account?</span>
      <a href="./registration.php">create new one</a>
    </div>

  </div>

  <!-- link bootstrap-5 js file -->
  <script src="./assets/fw/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>

  <!-- link main js file -->
  <script src="./assets/js/scripts.js"></script>

</body>

</html>