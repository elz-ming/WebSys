<?php
  /// Establish database connection
  include "connectDB.php";

  $type = $_GET['type'];
  $detail = $conn->real_escape_string($_GET['detail']); // Prevent SQL injection

  // Determine the SQL query based on the type of filter
  $query = "";
  if ($type == 'country') {
      $query = "
        SELECT blog.id, blog.title, blog.subtitle, blog.image_path, user.first_name, user.last_name 
        FROM blog 
        JOIN user ON blog.user_id = user.id 
        WHERE country = ?";
        
  } elseif ($type == 'category') {
      $query = "
        SELECT blog.id, blog.title, blog.subtitle, blog.image_path, user.first_name, user.last_name 
        FROM blog 
        JOIN user ON blog.user_id = user.id 
        WHERE category = ?";

  } else {
      // Default case, maybe handle errors or set a default query
      $query = "
        SELECT blog.id, blog.title, blog.subtitle, blog.image_path, user.first_name, user.last_name 
        FROM blog 
        JOIN user ON blog.user_id = user.id";
  }

  // Prepare, bind, execute, and fetch results
  $response = [];
  if ($stmt = $conn->prepare($query)) {
      if ($type != 'all') { // Skip binding for 'all' types
          $stmt->bind_param("s", $detail);
      }
      $stmt->execute();
      $result = $stmt->get_result();

      while ($row = $result->fetch_assoc()) {
          $response[] = $row; // Collect all rows
      }

      $stmt->close();
  }

  $conn->close();

  // Set header to return JSON content
  header('Content-Type: application/json');
  echo json_encode($response);
?>
