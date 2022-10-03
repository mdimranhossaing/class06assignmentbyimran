<?php 
  require_once( dirname( __FILE__ ) . './header.php' );

  if (!isset($_GET['user_id'])) {
    header('location: admin.php');
  } else {

    if (isset($_REQUEST['update'])) { // is set update form

      $user_id =  $_GET["user_id"];
      $username = test_input($_REQUEST['username']);
      $email = test_input($_REQUEST['email']);
      $error = array();

      
      // form validation
      if (empty($username)) {
        $error['username'] = 'Username is required.';
      } elseif (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
        $error['username'] = 'Only letters and white space allowed.';
      }

      $select_email = "SELECT `email` FROM `users` WHERE `email` = '$email'";
      $select_email_query = $connection->query($select_email);

      if (empty($email)) {
        $error['email'] = 'Email is required.';
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Invalid email format.';
      } elseif ($select_email_query->num_rows > 0) {
        $error['email'] = 'This email is already being used, Please insert another email.';
      }



      if (count($error) == 0 ) {
        $sql = "UPDATE users SET username='$username', email = '$email' WHERE user_id = '$user_id' ";

        if ($connection->query($sql) === true) {
          header('location: admin.php');
        }
      }

    }

  }

?>

  <main class="main py-5 create-user-body">
    
    <section class="create-user">
      <div class="container">
        <form class="bg-light" action="" method="POST">
        <h2 class="title mb-3">Update user</h2>
          <?php 
            $user_id =  $_GET["user_id"];

            $select_sql = "SELECT * FROM users WHERE user_id = '$user_id'";
            $select_result = $connection->query($select_sql);

            if ($select_result->num_rows > 0) :
              while($row = $select_result->fetch_assoc()) :
          ?>
          <div class="row">

            <div class="col-md-12 mb-3">
              <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username" value="<?php echo $row['username']; ?>">
              <?php
                if (isset($error["username"])) {
                  echo '<div style="color:rgb(245, 108, 98);">' . $error["username"] . '</div>';
                }
              ?>
            </div>

            <div class="col-md-12 mb-3">
              <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" value="<?php echo $row['email']; ?>">
              <?php
                if (isset($error["email"])) {
                  echo '<div style="color:rgb(245, 108, 98);">' . $error["email"] . '</div>';
                }
              ?>
            </div>

            <div class="col-md-12 text-end">
              <input type="reset" class="btn btn-danger me-2" value="Fields Reset">
              <input type="submit" class="btn btn-success" name="update" value="Submit">
            </div>

          </div>

          <?php
              endwhile;
            endif;
          ?>

        </form>
      </div>
    </section>
  </main>

  <?php 
    require_once( dirname( __FILE__ ) . './footer.php');
  ?>