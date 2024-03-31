<?php
// Establish database connection
include "connectDB.php";

$id = $_GET['id'] ?? ''; // Ensure to validate and sanitize

if (!$id) {
    echo json_encode(['error' => 'Missing ID']);
    exit;
}

$query = "
  SELECT id,
          blog_id, 
          pname,
          content, 
          destination, 
          duration,
          price,
          image_path 
  FROM package
  WHERE id = ?";
  
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

header('Content-Type: application/json');
if ($item = $result->fetch_assoc()) {
    echo json_encode($item);
} else {
    echo json_encode(['error' => 'Item not found']);
}


?>