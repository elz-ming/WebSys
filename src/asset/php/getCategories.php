<?php
  // Establish database connection
  include "connectDB.php";

  $result = $conn->query("SELECT DISTINCT category FROM blog ORDER BY category ASC");
  $categories = [];
  while($row = $result->fetch_assoc()) {
      $categories[] = $row['category'];
  }

  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($categories);
?>