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
$user_id = sanitize_input($_POST['user_id']);
$title = sanitize_input($_POST['title']);
$subtitle = sanitize_input($_POST['subtitle']);
$country = sanitize_input($_POST['country']);
$category = sanitize_input($_POST['category']);
$para_intro = sanitize_input($_POST['para_intro']);
$heading_1 = sanitize_input($_POST['heading_1']);
$para_1 = sanitize_input($_POST['para_1']);
$heading_2 = sanitize_input($_POST['heading_2']);
$para_2 = sanitize_input($_POST['para_2']);
$heading_3 = sanitize_input($_POST['heading_3']);
$para_3 = sanitize_input($_POST['para_3']);
$image_path = sanitize_input($_POST['image_path']);

$query = "UPDATE blog SET user_id=?, title=?, subtitle=?, country=?, category=?, para_intro=?, heading_1=?, para_1=?, heading_2=?, para_2=?, heading_3=?, para_3=?, image_path=? WHERE id=?";
$stmt = $conn->prepare($query);


if (false === $stmt) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare the update statement']);
    exit;
};

$stmt->bind_param('issssssssssssi', $user_id, $title, $subtitle, $country, $category, $para_intro, $heading_1, $para_1, $heading_2, $para_2, $heading_3, $para_3, $image_path, $id);
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