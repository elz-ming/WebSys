<?php
// Establish database connection
include "connectDB.php";

function sanitize_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Assume all necessary fields are submitted. Validate and sanitize them before use.
$id = sanitize_input($_POST['id']);
$blog_id = sanitize_input($_POST['blog_id']);
$pname = sanitize_input($_POST['pname']);
$content = sanitize_input($_POST['content']);
$destination = sanitize_input($_POST['destination']);
$duration = sanitize_input($_POST['duration']);
$price = sanitize_input($_POST['price']);
$image_path = sanitize_input($_POST['image_path']);

$query = "UPDATE package SET blog_id=?, pname=?, content=?, destination=?, duration=?, price=?, image_path=? WHERE id=?";
$stmt = $conn->prepare($query);


if (false === $stmt) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare the update statement']);
    exit;
};

$stmt->bind_param('issssssi', $blog_id, $pname, $content, $destination, $duration, $price, $image_path, $id);
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Package updated successfully']);
} else {
    // Handle error here
    echo json_encode(['success' => false, 'message' => 'Failed to update the package']);
}

header('Content-Type: application/json');
$stmt->close();
$conn->close();
?>