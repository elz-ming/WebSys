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
          user_id,
          created_at,
          title,
          subtitle, 
          country,
          category,
          like_count,
          comment_count,
          para_intro,
          heading_1,
          para_1, 
          heading_2,
          para_2, 
          heading_3,
          para_3,
          image_path
  FROM blog
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