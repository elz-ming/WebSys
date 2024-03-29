<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Make sure to add a version query to your CSS file to avoid caching issues -->
<link rel="stylesheet" href="/asset/css/checkout.css?v=1.0">
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
              <td><img src='https://dl.dropboxusercontent.com/s/sim84r2xfedj99n/%24_32.JPG' class='full-width'></td>
              <td>
                <br> <span class='thin'>PNAME</span>
                <br>
                <span>Free Run 3.0 Women</span>
                <br>
                <span class='thin small'> Color: Grey/Orange, Size: 10.5</span>
              </td>
            </tr>
            <tr>
              <td>
                <div class='price'>PRICE</div>
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
            <span>PRICE</span>
          </span>
        </div>
      </div>
    </div>
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
        <button href="checkoutsuccess.php" class='pay-btn'>Checkout</button>
        <!-- Back button -->
        <br><br><br>
        <button class='back-btn' onclick="window.location.href='package.php'">Back</button>
      </div>
    </div>
  </div>
</div>
<script src="asset/js/checkout.js"></script>
</body>
</html>
