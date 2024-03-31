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


$query = "
  INSERT INTO blog (user_id,
                    title, 
                    subtitle,
                    country,
                    category,
                    para_intro,
                    heading_1,
                    para_1,
                    heading_2,
                    para_2,
                    heading_3,
                    para_3,
                    image_path) 
  VALUES ('$user_id', '$title', '$subtitle', '$country', '$category', '$para_intro', '$heading_1', '$para_1', '$heading_2', '$para_2', '$heading_3', '$para_3', '$image_path')";

header('Content-Type: application/json');
if ($conn->query($query) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Blog added successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error adding blog: ' . $conn->error]);
}

$conn->close();
?>