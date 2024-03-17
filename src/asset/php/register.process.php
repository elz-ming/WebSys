<?php
// Function to sanitize input data
function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables and error messages
$email = $fname = $lname = $pwd_hashed = $errorMsg = "";
$success = false; // Default to false, set to true only on successful registration

// Database configuration file path
$dbConfigPath = '/var/www/private/db-config.ini';

// Helper function to write the member data to the database
function saveMemberToDB($fname, $lname, $email, $pwd_hashed, &$errorMsg)
{
    global $dbConfigPath;
    $config = parse_ini_file($dbConfigPath);
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        return false;
    }

    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        return false;
    }

    $stmt = $conn->prepare("INSERT INTO world_of_pets_members (fname, lname, email, password) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        $errorMsg = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        $conn->close();
        return false;
    }

    $stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed);
    if (!$stmt->execute()) {
        $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        $stmt->close();
        $conn->close();
        return false;
    }

    $stmt->close();
    $conn->close();
    return true;
}

// Process POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    if (empty ($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
        }
    }

    if (empty ($_POST["fname"])) {
        $errorMsg .= "First name is required.<br>";
    } else {
        $fname = sanitize_input($_POST["fname"]);
    }

    if (empty ($_POST["lname"])) {
        $errorMsg .= "Last name is required.<br>";
    } else {
        $lname = sanitize_input($_POST["lname"]);
    }

    if (empty ($_POST["pwd"]) || empty ($_POST["pwd_confirm"])) {
        $errorMsg .= "Password and Confirm password are required.<br>";
    } else {
        $password = $_POST["pwd"];
        $confirm_password = $_POST["pwd_confirm"];
        if ($password !== $confirm_password) {
            $errorMsg .= "Passwords do not match.<br>";
        } else {
            // Hash the password
            $pwd_hashed = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    // If no errors, save to DB
    if (empty ($errorMsg)) {
        $success = saveMemberToDB($fname, $lname, $email, $pwd_hashed, $errorMsg);
    }
}

?>

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <title>Registration Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
            background-image: url("images/RegistrationS.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .success {
            color: #008000;
        }

        .error {
            color: #FF0000;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php

        if ($success) {
            // Registration successful
            // You can perform database operations here if needed
            echo "<h2 class='success'>Registration Successful!</h2>";
            echo "<p>Welcome, $fname $lname! Thank you for registering with us.</p>";
        } else {
            // Registration failed
            echo "<h2 class='error'>Registration Failed</h2>";
            echo "<p>The following errors occurred:</p>";
            echo "<ol>";
            echo "<li>$errorMsg</li>";
            echo "</ol>";
            echo "<p>Please go back and correct the errors.</p>";
        }
        ?>
    </div>
</body>