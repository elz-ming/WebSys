<?php
session_start();
// Unset all session variables
session_unset();
// Destroy the session
session_destroy();
// Redirect to the home page or wherever you want after logout
header("Location: index.php");
exit();
?>
