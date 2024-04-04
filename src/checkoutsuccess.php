<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to index.php
    header("Location: /package.php");
    exit;
}

// Now, check if the user is logged in and set the variables.
$isLoggedIn = isset($_SESSION['user_id']); // Check if the user is logged in.
$userFirstName = $isLoggedIn ? $_SESSION['first_name'] : '';
$userLastName = $isLoggedIn ? $_SESSION['last_name'] : '';

// Establish database connection
include "connectDB.php";

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page Logo -->
    <link rel="icon" type="image/png" href="/asset/image/favicon.png">

    <title>Successful!</title>
    <link rel="stylesheet" href="asset/css/checkoutsuccess.css">
    </head>
<body>
    <div class="container">
        <h2 class='success'>Checkout Successful!</h2>
        <p>Dear <?php echo htmlspecialchars($userFirstName); ?> <?php echo htmlspecialchars($userLastName); ?>,</p>
        <p>Your order has been placed successfully!</p>
        <p><a href='/index.php'>Return to Home</a></p>
    </div>
</body>
</html>
