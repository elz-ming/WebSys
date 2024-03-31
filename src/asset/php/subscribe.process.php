<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Sanitize input data
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to send a thank you email
function sendThankYouEmail($email)
{
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

    $mail->isHTML(true);
    $mail->Subject = 'Thank You for Subscribing!';
    $mail->Body = 'Thank you for subscribing with us. We look forward to sending you the best travel content!';
    $mail->AltBody = 'Thank you for subscribing with us. We look forward to sending you the best travel content!';

    if (!$mail->send()) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return 'Message sent!';
    }
}

// Save subscriber to DB
function saveSubscriberToDB($fullname, $email)
{
    // Establish database connection
    include "connectDB.php";

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT email FROM subscribers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        return 'exists';
    } else {
        $stmt->close(); // Close the previous statement before opening a new one
        
        $stmt = $conn->prepare("INSERT INTO subscribers (fullname, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $fullname, $email);
        if ($stmt->execute()) {
            $stmt->close();
            if(sendThankYouEmail($email)) {
                return 'success';
            } else {
                return 'email_error';
            }
        } else {
            $stmt->close();
            return 'db_error';
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = sanitize_input($_POST["fullname"]); // Make sure the form field is named "fullname"
    $email = sanitize_input($_POST["email"]);

    $result = saveSubscriberToDB($fullname, $email);


    // Redirect to your landing page with a query parameter based on the result
    header("Location: https://traveltalk.site/index.php?subscribe=$result#subscribe");
    //header("Location: http://localhost:61246/index.php?subscribe=$result#subscribe");
    exit();
}
