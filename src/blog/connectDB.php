<?php
  $config = parse_ini_file('../../db-config.ini');
  //$config = parse_ini_file('/var/www/private/db-config.ini');
  if (!$config) {
    $errorMsg = "Failed to read database config file.";
    $success = false;
    return;
  }

  $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
?>