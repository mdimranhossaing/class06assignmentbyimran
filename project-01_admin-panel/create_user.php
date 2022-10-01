<?php 
  require_once( dirname( __FILE__ ) . './header.php' );
?>

  <main class="main py-5 create-user-body">
    
    <section class="create-user">
      <div class="container">
        <form class="bg-light" action="" method="POST">
          <div class="row">

            <div class="col-md-6 mb-3">
              <label for="fname" class="form-label">First name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter your firstname" required>
            </div>

            <div class="col-md-6 mb-3">
              <label for="lname" class="form-label">Last name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter your lastname" required>
            </div>

            <div class="col-md-12 mb-3">
              <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <div class="col-md-12 mb-4">
              <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
              <input type="email" class="form-control" name="password" id="password" placeholder="Enter a new password" required>
            </div>

            <div class="col-md-12 text-end">
              <input type="reset" class="btn btn-danger me-2" value="Fields Reset">
              <input type="submit" class="btn btn-success" name="submit" value="Submit">
            </div>

          </div>
        </form>
      </div>
    </section>
  </main>

  <?php 
    require_once( dirname( __FILE__ ) . './footer.php');
  ?>