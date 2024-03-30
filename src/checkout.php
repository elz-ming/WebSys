<?php
// Load database config
$config = parse_ini_file('../db-config.ini');
if (!$config) {
    die("Failed to read database config file.");
}

// Establish database connection
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch package details from the database
if (isset($_GET['package_id'])) {
    $package_id = $conn->real_escape_string($_GET['package_id']);
    $sql = "SELECT * FROM package WHERE id = '$package_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();
    } else {
        die("Package not found.");
    }
} else {
    die("No package ID provided.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/asset/css/checkout.css?v=1.0">
    <title>Checkout</title>
</head>
<body>
<div class='container'>
    <div class='window'>
        <div class='order-info'>
            <div class='order-info-content'>
                <h2>Order Summary</h2>
                <div class='line'></div>
                <table class='order-table'>
                    <tbody>
                        <tr>
                            <td><img src='<?php echo $package["image_path"]; ?>' class='full-width'></td>
                            <td>
                                <br> <span class='thin'><?php echo $package["pname"]; ?></span>
                                <br>
                                <span class='thin small'>Package Destination: <?php echo $package["destination"]; ?></span>
                                <br>
                                <span class='thin small'>Package Duration: <?php echo $package["duration"]; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='price'><?php echo $package["price"]; ?></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class='line'></div>
                <div class='total'>
                    <span style='float:left;'>
                        <span>TOTAL</span>
                    </span>
                    <span style='float:right; text-align:right;'>
                        <span><?php echo $package["price"]; ?></span>
                    </span>
                </div>
            </div>
        </div>
        <!-- Credit info and other inputs -->
        <div class='credit-info'>
      <div class='credit-info-content'>
        <table class='half-input-table'>
          <tr>
            <td>Please select your card: </td>
            <td>
              <div class='dropdown' id='card-dropdown'>
                <div class='dropdown-btn' id='current-card'>Visa</div>
                <div class='dropdown-select'>
                  <ul>
                    <li>Master Card</li>
                    <li>American Express</li>
                  </ul>
                </div>
              </div>
            </td>
          </tr>
        </table>
        <img src='https://dl.dropboxusercontent.com/s/ubamyu6mzov5c80/visa_logo%20%281%29.png' height='80' class='credit-card-image' id='credit-card-image'>
        Card Number
        <input class='input-field' id='card-number'>
        Card Holder
        <input class='input-field' id='card-holder'>
        <table class='half-input-table'>
          <tr>
            <td> 
              <span>Expires</span>
              <input class='input-field' id='expires'>
            </td>
            <td>
              <span>CVC</span>
              <input class='input-field' id='cvc'>
            </td>
          </tr>
        </table>
        <button href="/checkoutsuccess.php" class='pay-btn'>Checkout</button>
        <!-- Back button -->
        <br><br><br>
        <button class='back-btn' href='package.php'>Back</button>
      </div>
    </div>
    </div>
</div>
<script src="asset/js/checkout.js"></script>
</body>
</html>
<?php
$conn->close();
?>
