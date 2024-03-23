<head>
    <?php 
    // include "inc/head.inc.php";
     ?>
</head>
<style>
    
        .result-container {
        border-top:1px solid;
        width: 50%;
        margin: 15px auto 0 auto;
        }
        .success-button {
            margin-top: 10px;
            padding: 20px 20px;
            background-color: #297E2D; /* Green background color */
            color: white; /* White text color */
            border: none; /* Remove borders */
            border-radius: 5px; /* Optional: Rounded corners */
            cursor: pointer;
            margin: auto;
        }

        .return-button {
            margin-top: 10px;
            padding: 20px 20px;
            background-color: #FF5733; /* Red background color */
            color: white; /* White text color */
            border: none; /* Remove borders */
            border-radius: 5px; /* Optional: Rounded corners */
            cursor: pointer;
            margin: auto;
        }

        footer {
            margin-top: 20px;
            width: 50%;
            padding-top: 10px;
            margin: 15px auto 0 auto;

        }


        
    </style>

<body>
    <?php 
    // include "inc/nav.inc.php";
     ?>

<?php

/* 
 * Helper function to write the member data to the database. 
 */ 
function saveMemberToDB() 
{ 
    global $first_name, $last_name, $email, $pwd_hashed, $errorMsg, $success; 
 
    // Create database connection. 
    $config = parse_ini_file('/var/www/private/db-config.ini'); 
    if (!$config) 
    { 
        $errorMsg = "Failed to read database config file."; 
        $success = false; 
    } 
    else 
    { 
        $conn = new mysqli( 
            $config['servername'], 
            $config['username'], 
            $config['password'], 
            $config['dbname'] 
        ); 
 
        // Check connection 
        if ($conn->connect_error) 
        { 
            $errorMsg = "Connection failed: " . $conn->connect_error; 
            $success = false; 
        } 
        else 
        { 
            // Prepare the statement: 
            $stmt = $conn->prepare("INSERT INTO user 
                (first_name, last_name, email, password) VALUES (?, ?, ?, ?)"); 
 
            // Bind & execute the query statement: 
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $pwd_hashed); 
            if (!$stmt->execute()) 
            { 
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . 
                    $stmt->error; 
                $success = false; 
            } 
            $stmt->close(); 
        } 
 
        $conn->close(); 
    } 
}




$email = $last_name = $pwd = $pwd_confirm = $errorMsg = "";
$success = true;

if (empty($_POST["email"])) {
    $errorMsg .= "Email is required.<br>";
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]);
    // Additional check to make sure e-mail address is well-formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.<br>";
        $success = false;
    }
}

if (empty($_POST["last_name"])) {
    $errorMsg .= "Last name is required.<br>";
    $success = false;
} else {
    $last_name = sanitize_input($_POST["last_name"]);
    // Additional checks for last name if needed
}

if (empty($_POST["pwd"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else {
    $pwd = $_POST["pwd"];
    // Additional checks for password if needed
}

if (empty($_POST["pwd_confirm"])) {
    $errorMsg .= "Confirm Password is required.<br>";
    $success = false;
} else {
    $pwd_confirm = $_POST["pwd_confirm"];
    if ($pwd !== $pwd_confirm) {
        $errorMsg .= "Passwords do not match.<br>";
        $success = false;
    }
}

if ($success) {
    // Hash the password using password_hash
    $pwd_hashed = password_hash($pwd, PASSWORD_DEFAULT);

    saveMemberToDB($first_name, $last_name, $email, $pwd_hashed);

    // Perform any additional processing or database operations here
    // ...
    echo '<div class="result-container">';
    echo "<h1>Your registration is successful!</h1>";
    echo "<h3>Thank you for joining us.</h3>";
    echo "<p><strong>Email:</strong> " . $email . "</p>";
  /*   Adds "Login" Button */
    echo '<button class="success-button" onclick="window.location.href=\'register.php\'">Log-in</button>';
    echo '</div>';
    // Additional success messages or redirection to a success page
} else {
    echo '<div class="result-container">';
    echo "<h1>Oops!";
    echo "<h3>The following input errors were detected:</h4>";
    echo "<p>" . $errorMsg . "</p>";
    /* Add a Return to Register Button */
    echo '<button class="return-button" onclick="window.location.href=\'register.php\'">Return to Register</button>';
    echo '</div>';
}

/*
 * Helper function that checks input for malicious or unwanted content.
 */
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>




<?php
// include "inc/footer.inc.php";
?>
                    
