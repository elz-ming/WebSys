<?php
// get_package_details.php
$packageId = $_GET['package_id'] ?? null;

if ($packageId) {
    // Load database config
    $config = parse_ini_file('../db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if (!$conn->connect_error) {
        $sql = "SELECT * FROM package WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $packageId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode($row);
        }
    }
    $conn->close();
}
?>
