<?php 

  // setup server information
  define('__HOST__', 'localhost');
  define('__DATABASE__', 'mycms');
  define('__USERNAME__', 'root');
  define('__PASSWORD__', '');
  
  // create connection
  $connection = new mysqli(__HOST__,__USERNAME__,__PASSWORD__,__DATABASE__);
  
  // check connection
  if ( $connection->connect_error ) {
    $server_conn_msg = 'Server disconnected';
  } else {
    $server_conn_msg = 'Server connected';
  }

?>