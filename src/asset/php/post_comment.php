<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['blog_id']) && !empty($_POST['comment'])) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['temp_comment'] = htmlspecialchars($_POST['comment']); // Save comment temporarily
            $_SESSION['temp_blog_id'] = htmlspecialchars($_POST['blog_id']); // Save blog ID temporarily
            $_SESSION['redirect_after_login'] = '/blog/post.php?blog_id=' . $_POST['blog_id']; // Save redirect page
            header("Location: /login.php"); // Adjust the login URL as needed
            exit;
        }
        
        // Sanitize input to prevent XSS attacks
        $user_id = htmlspecialchars($_SESSION['user_id']);
        $blog_id = htmlspecialchars($_POST['blog_id']);
        $content = htmlspecialchars($_POST['comment']);

        // Load database config and create connection
        $config = parse_ini_file('../../../db-config.ini'); // Adjust the path as needed
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO comment (user_id, blog_id, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $blog_id, $content); // Ensure these variable names correctly correspond to your form and database schema

        // Execute the statement and check for success
        if ($stmt->execute()) {
            //Choose correct location based on your file structure
            header("Location: /blog/post.php?blog_id=" . $blog_id . '#comments'); 
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
        
        // Clear temporary variables if it exists
        unset($_SESSION['temp_comment']);
        unset($_SESSION['temp_blog_id']);
        unset($_SESSION['redirect_after_login']);
    } else {
        echo "Invalid request.";
    }
?>
