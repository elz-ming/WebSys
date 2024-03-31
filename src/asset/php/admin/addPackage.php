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
$blog_id = sanitize_input($_POST['blog_id']);
$pname = sanitize_input($_POST['pname']);
$content = sanitize_input($_POST['content']);
$destination = sanitize_input($_POST['destination']);
$duration = sanitize_input($_POST['duration']);
$price = sanitize_input($_POST['price']);
$image_path = sanitize_input($_POST['image_path']);

$query = "
  INSERT INTO package (blog_id,
                    pname, 
                    content,
                    destination,
                    duration,
                    price,
                    image_path) 
  VALUES ('$blog_id', '$pname', '$content', '$destination', '$duration', '$price', '$image_path')";

header('Content-Type: application/json');
if ($conn->query($query) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Blog added successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error adding blog: ' . $conn->error]);
}

$conn->close();
?>