<?php
// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}

// Now, check if the user is logged in and set the variables.
$isLoggedIn = isset($_SESSION['user_id']); // Check if the user is logged in.
$userFirstName = $isLoggedIn ? $_SESSION['first_name'] : '';
$userLastName = $isLoggedIn ? $_SESSION['last_name'] : '';

 // Load database config
 $config = parse_ini_file('../db-config.ini');
 if (!$config) {
     echo "Failed to read database config file.";
     exit;
 }

// Establish database connection
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit;
}

// Check if the user is logged in
if ($isLoggedIn) {
    // Query to get the user's first name and last name from the database
    $userId = $_SESSION['user_id'];
    $sql = "SELECT first_name, last_name FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userFirstName = $row['first_name'];
        $userLastName = $row['last_name'];
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout Result</title>
    <!-- Your CSS and other head content -->
    <link rel="stylesheet" href="asset/css/checkoutsuccess.css">
    </head>
<body>
    <div class="container">
        <!-- Assuming the checkout is always successful -->
        <h2 class='success'>Checkout Successful!</h2>
        <p>Dear <?php echo htmlspecialchars($userFirstName); ?> <?php echo htmlspecialchars($userLastName); ?>,</p>
        <p>Your order has been placed successfully!</p>
        <p><a href='/index.php'>Return to Home</a></p>
    </div>
</body>
</html>
