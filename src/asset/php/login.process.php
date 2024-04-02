<?php
// Initialize variables
$email = $password = $errorMsg = $first_name = $last_name = "";
$success = false; // Assume failure until verification

// Function to sanitize input data
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validate and sanitize input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty ($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
        }
    }

    if (empty ($_POST["pwd"])) {
        $errorMsg .= "Password is required.<br>";
    } else {
        $password = sanitize_input($_POST["pwd"]);
    }

    // If validation successful, attempt to log in
    if (empty ($errorMsg)) {
        // Establish database connection
        include "connectDB.php";

        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT id, first_name, last_name, password, verified, admin FROM user WHERE email = ?");
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
                    $_SESSION['loggedin'] = true;

                    if ($row['admin'] == 1) {
                        $_SESSION['admin'] = true;
                    }

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
                } else {
                    $errorMsg = "Your account is not verified. Please check your email to verify it.";
                }
            } else {
                $errorMsg = "Invalid password. Please try again.";
            }
        } else {
            $errorMsg = "User not found. Please try again.";
        }
        $stmt->close();
        $conn->close();
    }
}

if (!empty($errorMsg)) {
    header('Location: /login.php?error=' . urlencode($errorMsg));
    exit;
}
?>
