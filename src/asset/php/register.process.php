<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

// Function to sanitize input data
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function sendVerificationEmail($email, $id, $vkey)
{

    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    // Server settings
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_OFF; // Set to DEBUG_OFF for production
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Username = 'traveltalks1005@gmail.com';
    $mail->Password = 'fivg kbsr golp tjtb';

    // Recipients
    $mail->setFrom('traveltalks1005@gmail.com', 'TravelTalks Team');
    $mail->addAddress($email); // Add the user's email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Email Verification from TravelTalks';

    // Create the verification link
    $verification_link = "https://traveltalk.site//verify.php?id=$id&key=$vkey";

    // Set email body
    $mail->Body = "Thank You for registering with us. Click <a href='$verification_link'>here</a> to verify your account.";
    $mail->AltBody = "Thank You for registering with us. Copy and paste the following link in your browser to verify your account: $verification_link";

    // Send the email and check for errors
    if (!$mail->send()) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return 'Message sent!';
    }
}

// Helper function to write the member data to the database
function saveMemberToDB()
{
    global $first_name, $last_name, $email, $pwd_hashed, $errorMsg, $success;
    // Load database config
    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
        return;
    }

    // Establish database connection
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
        return;
    }


    // Check if email already exists
    $checkEmailStmt = $conn->prepare("SELECT email FROM user WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();
    if ($checkEmailStmt->num_rows > 0) {
        $errorMsg = "Email already registered.";
        $success = false;
        return; // Early return if email exists
    }
    $checkEmailStmt->close();

    // Prepare insert statement
    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, password, verified) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        $errorMsg = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        $success = false;
        $conn->close();
        return;
    }

    $verified = 0; // Assuming 0 means unverified
    $stmt->bind_param("ssssi", $first_name, $last_name, $email, $pwd_hashed, $verified);
    if (!$stmt->execute()) {
        $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        $success = false;
    } else {
        $success = true;
        $id = $stmt->insert_id;
        $vkey = bin2hex(random_bytes(16)); // create a random verification key

        // Update the user record with the verification key
        $update_stmt = $conn->prepare("UPDATE user SET vkey = ? WHERE id = ?");
        $update_stmt->bind_param("si", $vkey, $id);
        $update_stmt->execute();
        $update_stmt->close();

        // Send verification email
        $emailSendStatus = sendVerificationEmail($email, $id, $vkey);

        $stmt->close();
        $conn->close();
    }
}

// Initialize variables
$email = $errorMsg = "";
$success = true; // Assume success until a test fails

// Validate and sanitize input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty ($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
            $success = false;
        }
    }

    if (empty ($_POST["first_name"])) {
        $errorMsg .= "First name is required.<br>";
        $success = false;
    } else {
        $first_name = sanitize_input($_POST["first_name"]);
    }

    if (empty ($_POST["last_name"])) {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    } else {
        $last_name = sanitize_input($_POST["last_name"]);
    }

    if (empty ($_POST["pwd"]) || empty ($_POST["pwd_confirm"])) {
        $errorMsg .= "Password and Confirm password are required.<br>";
        $success = false;
    } else {
        $password = $_POST["pwd"];
        $confirm_password = $_POST["pwd_confirm"];
        if ($password !== $confirm_password) {
            $errorMsg .= "Passwords do not match.<br>";
            $success = false;
        } else {
            // Hash the password
            $pwd_hashed = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    // If validation successful, save to DB
    if ($success) {
        saveMemberToDB();
    }
}
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

    <?php
    ?>
    <div class="container">
        <?php

        if ($success) {
            // Registration successful
            // You can perform database operations here if needed
            echo "<h2 class='success'>Registration Successful!</h2>";
            echo "<p>Welcome, $first_name $last_name! Thank you for registering with us.</p>";
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