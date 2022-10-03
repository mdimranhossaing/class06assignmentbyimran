<?php 
 require_once( dirname( __FILE__ ) . './header.php' );

 if (!isset($_GET['delete_id'])) {
  header('location: admin.php');
 } else {
  $delete_id = $_GET['delete_id'];
  $delete_sql = "DELETE FROM users  WHERE user_id = '$delete_id'";

  if ($connection->query($delete_sql) === true) {
    header('location: admin.php');
  }
 }


?>