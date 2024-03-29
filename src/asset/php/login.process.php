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
                        // header("Location: ../../index.php");
                        // exit();
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
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Result</title>
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
            color: green;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if ($success) {
            // Login successful
            echo "<h2 class='success'>Login Successful!</h2>";
            echo "<p>Welcome back, " . htmlspecialchars($first_name) . " " . htmlspecialchars($last_name) . "!</p>";
            echo "<p><a href='../../index.php'>Return to Home</a></p>";
        } else {
            // Login failed
            echo "<h2 class='error'>Login Failed</h2>";
            if (!empty($errorMsg)) {
                echo "<p>The following errors occurred:</p>";
                echo "<div class='error'>" . nl2br(htmlspecialchars($errorMsg)) . "</div>";
            }
            echo "<p>Please go back and try again.</p>";
            echo "<p><a href='../../login.php'>Return to Login</a></p>";
        }
        ?>
    </div>
</body>
</html>
