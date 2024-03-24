<!-- Debugging Purposes (Darryl), can be deleted at the end of development -->

<?php

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
 $mail->Host = 'smtp.gmail.com';
// //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
// //if your network does not support SMTP over IPv6,
// //though this may cause issues with TLS

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
$mail->Port = 465;

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = 'ssl';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'traveltalks1005@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'fivg kbsr golp tjtb';

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$mail->setFrom('traveltalks1005@gmail.com', 'TravelTalks Team');


//Set who the message is to be sent to
$mail->addAddress('traveltalks1005@gmail.com', 'John Doe');

//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';


// Content
$mail->isHTML(true);                                 
$mail->Subject = 'Email Verification from TravelTalks';
$mail->Body = 'Thank You for registrating with us. Click here to verify your account: <b>Token</b>';
$mail->AltBody = 'Thank You for registrating with us. Click here to verify your account: <b>Token</b>';


//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
