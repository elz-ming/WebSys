<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout</title>
<link rel="stylesheet" href="asset/css/checkout.css">
<script src="asset/js/checkout.js"></script>
</head>
<body>

<div class="header">
    ORDER ONLINE OR CALL US @ (1800) 000 8080
</div>

<div class="container">
    <?php
    // Establish database connection
    include "connectDB.php";
    
    // Start the session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to index.php
        header("Location: /package.php");
        exit;
    }
    // Get the package ID from the query string
    $package_id = isset($_GET['package_id']) ? (int)$_GET['package_id'] : 0;

    // Fetch package details from the database
    $sql = "SELECT * FROM package WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $total = 0;
    ?>
    <div class="cart" id="cart">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $total += $row['price'];
            ?>
            <div class="book-item">
                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['pname']); ?>" style="width: 100px; height: 150px;">
                <div class="book-details">
                    <div class="book-title"><?php echo htmlspecialchars($row['pname']); ?></div>
                    <br>
                    <div>Destination: <?php echo htmlspecialchars($row['destination']); ?></div>
                    <div>Duration: <?php echo htmlspecialchars($row['duration']); ?></div>
                    <div class="book-price" data-original-price="<?php echo htmlspecialchars($row['price']); ?>">$<?php echo htmlspecialchars($row['price']); ?></div>
                    <br>
                    <div class="remove" onclick="removePackage(this)">Remove</div>
                </div>
                <div class="quantity-controls">
                    <button onclick="decreaseQuantity(this)">-</button>
                    <input type="text" value="1" style="width: 30px;" readonly>
                    <button onclick="addPackage(this)">+</button>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No packages in the order.</p>";
    }
    $stmt->close();
    $conn->close();
    ?>
    </div>

    <div class="summary">
        <h2>Order Summary</h2>
        <div class="summary-item total">Total Cart Value: <span id="totalCartValue">$<?php echo htmlspecialchars($total); ?></span></div>
        <textarea class="special-instruction" placeholder="Special Request"></textarea>
        
        <!-- Credit Card Form -->
        <div class="credit-card-form">
        <h3>Credit Card Details</h3>
        <div class="form-group">
            <label for="cardName">Name on Card</label>
            <input type="text" id="cardName" name="cardName" required>
        </div>
        <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <input type="text" id="cardNumber" name="cardNumber" maxlength="16" pattern="\d{16}" title="Card number must be 16 digits" required>
        </div>
        <div class="form-group">
            <label for="expiryDate">Expiry Date</label>
            <input type="text" id="expiryDate" name="expiryDate" maxlength="4" placeholder="MMYY" pattern="\d{4}" title="Expiry date must be in MMYY format" required>
        </div>
        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" maxlength="3" pattern="\d{3}" title="CVV must be 3 digits" required>
        </div>
    </div>

        <button onclick="if(validateCreditCard()) { window.location.href='/checkoutsuccess.php'; }" class="checkout">Checkout</button>
        <br><br>
        <button onclick="window.location.href='/package.php'" class="checkout">Back</button>
    </div>
</div>

</body>
</html>
