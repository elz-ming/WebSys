<?php
  // Establish database connection
  include "connectDB.php";

  $result = $conn->query("SELECT DISTINCT country FROM blog ORDER BY country ASC");
  $countries = [];
  while($row = $result->fetch_assoc()) {
      $countries[] = $row['country'];
  }

  $conn->close();

  header('Content-Type: application/json');
  
?>