<?php
// get_package_details.php
$packageId = $_GET['package_id'] ?? null;

if ($packageId) {
    // Establish database connection
    include "connectDB.php";

    $sql = "SELECT * FROM package WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $packageId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    }
    
    $conn->close();
}
?>
