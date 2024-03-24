<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['blog_id']) && !empty($_POST['comment'])) {
    $blog_id = $_POST['blog_id'];
    // Sanitize input to prevent XSS attacks
    $content = htmlspecialchars($_POST['comment']);

    // Load database config and create connection
    $config = parse_ini_file('../../../db-config.ini'); // Adjust the path as needed
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the INSERT statement
    $stmt = $conn->prepare("INSERT INTO comment (blog_id, content) VALUES (?, ?)");
    $stmt->bind_param("is", $blog_id, $content); // Ensure these variable names correctly correspond to your form and database schema

    // Execute the statement and check for success
    if ($stmt->execute()) {
        //Choose correct location based on your file structure
        //header("Location: https://traveltalk.site//blog/post.php?blog_id=" . $blog_id . '#comments');
        header("Location: http://localhost:54839/blog/post.php?blog_id=" . $blog_id . '#comments'); 
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}

?>
