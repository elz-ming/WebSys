<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Initialize a variable to hold the verification message
$verificationMessage = "Please wait while we verify your account...";

if (isset ($_GET['id']) && isset ($_GET['key'])) {
    $id = sanitize_input($_GET['id']);
    $vkey = sanitize_input($_GET['key']);

    // Establish database connection
    include "connectDB.php";

    // Binding to use 'id' and 'vkey' directly
    $stmt = $conn->prepare("SELECT id FROM user WHERE id = ? AND vkey = ?");
    $stmt->bind_param("is", $id, $vkey);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows == 1) {
        $update_stmt = $conn->prepare("UPDATE user SET verified = 1 WHERE id = ?");
        $update_stmt->bind_param("i", $id);
        $update_stmt->execute();
        $update_stmt->close();

        $verificationMessage = "Your account has been successfully verified!";
    } else {
        $verificationMessage = "The link is invalid or you have already verified your account.";
    }

    $conn->close();
} else {
    $verificationMessage = "No verification data provided.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="asset/css/verify.css">

</head>

<body>
    <div class="container">
        <header>
            <h1>Travel Talk</h1>
        </header>
        <main>
            <div class="verification-message">
                <p>
                    <?php echo $verificationMessage; ?>
                </p>
            </div>
        </main>
    </div>
    <div class="content-wrapper">
        <div class="cube-container">
            <div class="cube initial-position">
                <img class="cube-face-image image-1"
                    src="https://images.unsplash.com/photo-1445810694374-0a94739e4a03?w=300&h=300&fit=crop">
                <img class="cube-face-image image-2"
                    src="https://images.unsplash.com/photo-1515260268569-9271009adfdb?w=300&h=300&fit=crop">
                <img class="cube-face-image image-3"
                    src="https://images.unsplash.com/photo-1506045412240-22980140a405?w=300&h=300&fit=crop">
                <img class="cube-face-image image-4"
                    src="https://images.unsplash.com/photo-1514041181368-bca62cceffcd?w=300&h=300&fit=crop">
                <img class="cube-face-image image-5"
                    src="https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?w=300&h=300&fit=crop">
                <img class="cube-face-image image-6"
                    src="https://images.unsplash.com/photo-1486334803289-1623f249dd1e?w=300&h=300&fit=crop">
            </div>
        </div>
        <div class="image-buttons">
            <input type="image" class="show-image-1"
                src="https://images.unsplash.com/photo-1445810694374-0a94739e4a03?w=100&h=100&fit=crop"></input>
            <input type="image" class="show-image-2"
                src="https://images.unsplash.com/photo-1515260268569-9271009adfdb?w=100&h=100&fit=crop"></input>
            <input type="image" class="show-image-3"
                src="https://images.unsplash.com/photo-1506045412240-22980140a405?w=100&h=100&fit=crop"></input>
            <input type="image" class="show-image-4"
                src="https://images.unsplash.com/photo-1514041181368-bca62cceffcd?w=100&h=100&fit=crop"></input>
            <input type="image" class="show-image-5"
                src="https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?w=100&h=100&fit=crop"></input>
            <input type="image" class="show-image-6"
                src="https://images.unsplash.com/photo-1486334803289-1623f249dd1e?w=100&h=100&fit=crop"></input>
        </div>
    </div>
    </main>
    </div>
    <script src="asset/js/verify.js"></script>
</body>

</html>