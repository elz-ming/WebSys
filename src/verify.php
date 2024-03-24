<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['id']) && isset($_GET['key'])) {
    $id = sanitize_input($_GET['id']);
    $vkey = sanitize_input($_GET['key']);

    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        echo "Failed to read database config file.";
        return;
    }

    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
        return;
    }

    // Binding to use 'id' and 'vkey' directly
    $stmt = $conn->prepare("SELECT id FROM user WHERE id = ? AND vkey = ?");
    $stmt->bind_param("is", $id, $vkey);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows == 1) {
        $update_stmt = $conn->prepare("UPDATE user SET verified = 1 WHERE id = ?");
        $update_stmt->bind_param("i", $id);
        $update_stmt->execute();
        $update_stmt->close();

        echo "Your account has been successfully verified!";
    } else {
        echo "The link is invalid or you have already verified your account.";
    }

    $conn->close();
} else {
    echo "No verification data provided.";
}
