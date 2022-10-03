<?php

session_start();
require_once(dirname(__FILE__) . './header.php');

if ( !user_logged_in() ) {
  header('location: index.php');
}

$sql = "SELECT * FROM `users`";
$results = $connection->query($sql);

?>

<main class="main py-5">
  <section>
    <div class="container">
      <div class="table-responsive">
        <table class="table table-bordered table-light table-striped table-hover w-25 mx-auto">
          <thead class="table-dark text-light">
            <tr>
              <th>SN</th>
              <th>User ID</th>
              <th>Name</th>
              <th>Email address</th>
              <th>Password</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $sn = 0;
            if ($results->num_rows > 0) {
              while ($row = $results->fetch_assoc()) : ?>
                <?php ++$sn; ?>

                <tr>
                  <td><?php echo $sn; ?></td>
                  <td><?php echo $row['user_id']; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['password']; ?></td>
                  <td>
                    <a class="btn btn-success btn-sm me-2" href="<?php echo set_link('update'); ?>?user_id=<?php echo $row['user_id']; ?>">Edit</a>
                    <a class="btn btn-danger btn-sm" href="<?php echo set_link('delete'); ?>?delete_id=<?php echo $row['user_id']; ?>">Delete</a>
                  </td>
                </tr>

            <?php endwhile;
            } else {
              header('location: logout.php');
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php
require_once(dirname(__FILE__) . './footer.php');
?>