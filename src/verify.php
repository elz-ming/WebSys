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

    <!-- Page Logo -->
    <link rel="icon" type="image/png" href="/asset/image/favicon.png">

    <title>Verification successful!</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="asset/css/verify.css">

</head>

<body>
    <div class="container">
        <header>
            <h1><a href="/login.php">Travel Talk</a></h1>
        </header>
        <main>
            <div class="verification-message"> Message:
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
                    src="https://source.unsplash.com/man-in-swimming-pool-during-daytime-IzP7jvgwXo0/300x300" alt="Man in Swimming Pool">
                <img class="cube-face-image image-2"
                    src="https://source.unsplash.com/woman-in-red-and-orange-sweater-stands-on-stone-beside-water-JQ0YTMFhN5Q/300x300" alt="Woman in red and Orange">
                <img class="cube-face-image image-3"
                    src="https://source.unsplash.com/a-narrow-city-street-at-night-with-neon-lights-QXJCo9sSd20/300x300" alt="Narrow City Street">
                <img class="cube-face-image image-4"
                    src="https://source.unsplash.com/a-man-and-a-woman-standing-next-to-each-other-in-front-of-a-building-lSXYLGMQDSo/300x300" alt="man and woman standing">
                <img class="cube-face-image image-5"
                    src="https://source.unsplash.com/a-tree-that-is-standing-in-the-water-bCwYbTmixiw/300x300" alt="a tree that is standing">
                <img class="cube-face-image image-6"
                    src="https://source.unsplash.com/a-blue-lake-surrounded-by-trees-in-the-middle-of-a-forest-sPWA29VTgLk/300x300" alt="a blue lake surrounded by trees">
            </div>
        </div>
        <div class="image-buttons">
            <input type="image" class="show-image-1"
                src="https://source.unsplash.com/man-in-swimming-pool-during-daytime-IzP7jvgwXo0/100x100" alt="Man in Swimming Pool"></input>
            <input type="image" class="show-image-2"
                src="https://source.unsplash.com/woman-in-red-and-orange-sweater-stands-on-stone-beside-water-JQ0YTMFhN5Q/100x100" alt="Woman in red and Orange"></input>
            <input type="image" class="show-image-3"
                src="https://source.unsplash.com/a-narrow-city-street-at-night-with-neon-lights-QXJCo9sSd20/100x100" alt="Narrow City Street"></input>
            <input type="image" class="show-image-4"
                src="https://source.unsplash.com/a-man-and-a-woman-standing-next-to-each-other-in-front-of-a-building-lSXYLGMQDSo/100x100" alt="man and woman standing"></input>
            <input type="image" class="show-image-5"
                src="https://source.unsplash.com/a-tree-that-is-standing-in-the-water-bCwYbTmixiw/100x100" alt="a tree that is standing"></input>
            <input type="image" class="show-image-6"
                src="https://source.unsplash.com/a-blue-lake-surrounded-by-trees-in-the-middle-of-a-forest-sPWA29VTgLk/100x100" alt="a blue lake surrounded by trees"></input>
        </div>
    </div>
    </main>
    </div>
    <script src="asset/js/verify.js"></script>
</body>

</html>