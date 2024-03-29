<?php
// Include database connection, functions, etc.
// Make sure the path to db-config.ini is correct and the file is secured properly
require_once '../../../db-config.ini';

// Initialize variables
$email = $password = $errorMsg = $first_name = $last_name = "";
$success = false; // Assume failure until verification

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validate and sanitize input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
        }
    }

    if (empty($_POST["pwd"])) {
        $errorMsg .= "Password is required.<br>";
    } else {
        $password = sanitize_input($_POST["pwd"]);
    }

    // If validation successful, attempt to log in
    if (empty($errorMsg)) {
        // Establish database connection
        $config = parse_ini_file('../../../db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Unable to connect to the database. Please try again later.";
        } else {
            // Prepare the SQL statement
            $stmt = $conn->prepare("SELECT id, first_name, last_name, password, verified FROM user WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    if ($row['verified'] == 1) {
                        // The user is verified, can log in
                        $success = true;
                        $first_name = $row['first_name']; // Get the user's first name
                        $last_name = $row['last_name']; // Get the user's last name

                        // Set session variables and perform any other login actions here
                        session_start();
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['first_name'] = $first_name; // Store first name in session
                        $_SESSION['last_name'] = $last_name; // Store last name in session

                        // A redirection to another page could also go here
                        if (isset($_SESSION['redirect_after_login'])) {
                            $url = $_SESSION['redirect_after_login'];
                            unset($_SESSION['redirect_after_login']); // Clear it after use
                            header('Location: ' . $url);
                            exit;
                        } else {
                            // Default redirect if no specific page was stored
                            header('Location: /index.php');
                            exit;
                        }
                        exit();
                    } else {
                        $errorMsg = "Your account is not verified. Please check your email to verify it.";
                    }
                } else {
                    $errorMsg = "Invalid password.";
                }
            } else {
                $errorMsg = "User not found.";
            }
            $stmt->close();
            $conn->close();
            header('Location: /login.php');
        }
    }
}
?>