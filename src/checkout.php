<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout Page</title>
<link rel="stylesheet" href="/asset/css/checkout.css">
<style>
/* Add a checkout label */
.checkout-label {
  background: #3498db; /* blue background color */
  color: white;
  padding: 10px;
  text-align: center;
  font-size: 1.5rem;
}
</style>
</head>
<body>
  <div class="checkout-label">Checkout</div>
  <div class="model">
    <div class="room">
      <div class="text-cover">
        <h1>Danny's House</h1>
        <p class="price"> 120.00 <span>USD</span> / Night</p>
        <hr>
        <p>Entire Home for 1 guest</p>
        <p>Tues, Oct 2, 2017 to Friday, Oct 5, 2017</p>
      </div>
    </div><div class="payment">
      <div class="receipt-box">
        <h3>Reciept Summary</h3>
        <table class="table">
          <tr>
            <td>120 x 2 nights</td>
            <td>240.00 USD</td>
          </tr>
          <tr>
            <td>Discount</td>
            <td>0 USD</td>
          </tr>
          <tr>
            <td>Subtotal</td>
            <td>240 USD</td>
          </tr>
          <tr>
            <td>Tax</td>
            <td>10 USD</td>
          </tr>
          <tfoot>
            <tr>
              <td>Sum</td>
              <td>$180</td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="payment-info">
        <h3>Payment Info</h3>
        <form>
        <label>Name on Credit Card</label>
        <input type="text" name="firstname" value="Mickey">
        <label>Credit Card Number</label>
        <input type="text" name="lastname" value="Mouse">
        <br><br>
        <input class="btn" type="submit" value="Book Securly">
      </form>
      </div>
    </div>
  </div>
</body>
</html>
