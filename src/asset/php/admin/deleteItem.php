<?php
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;
$tableName = $data['table'] ?? '';

$response = ['success' => false];

// Whitelist of allowed tables
$allowedTables = ['blog', 'package'];

if ($id && in_array($tableName, $allowedTables)) {
    // Establish database connection
    include "connectDB.php";

    // Prepare the DELETE statement with the whitelisted table name
    $stmt = $conn->prepare("DELETE FROM {$tableName} WHERE id = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = 'Deletion failed';
    }

    $stmt->close();
    $conn->close();
} else {
    $response['error'] = 'Invalid table or ID';
}

header('Content-Type: application/json');
echo json_encode($response);
?>