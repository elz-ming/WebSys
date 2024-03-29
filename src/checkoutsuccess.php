<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout Result</title>
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
