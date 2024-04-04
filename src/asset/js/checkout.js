function removePackage(element) {
  var packageItem = element.closest('.book-item');
  packageItem.remove();
  updateTotalCartValue();
}

function addPackage(element) {
var quantityInput = element.previousElementSibling;
var quantity = parseInt(quantityInput.value);
quantityInput.value = quantity + 1;

updateTotalCartValue();
}

function decreaseQuantity(element) {
var quantityInput = element.nextElementSibling;
var quantity = parseInt(quantityInput.value);
if (quantity > 1) {
    quantityInput.value = quantity - 1;
    updateTotalCartValue();
}
}

function updateTotalCartValue() {
  var total = 0;
  var items = document.querySelectorAll('.book-item');
  items.forEach(function(item) {
      var priceElement = item.querySelector('.book-price');
      var originalPrice = parseFloat(priceElement.dataset.originalPrice);
      var quantity = parseInt(item.querySelector('input').value);
      total += originalPrice * quantity;
  });
  document.querySelector('.summary-item.total span').textContent = '$' + total.toFixed(2);
}

function validateCreditCard() {
  var cardName = document.getElementById('cardName').value.trim();
  var cardNumber = document.getElementById('cardNumber').value.trim();
  var expiryDate = document.getElementById('expiryDate').value.trim();
  var cvv = document.getElementById('cvv').value.trim();

  var cardNumberRegex = /^\d{16}$/;
  var expiryDateRegex = /^(0[1-9]|1[0-2])\d{2}$/; // Updated regex for MMYY format
  var cvvRegex = /^\d{3}$/;
  var cardNameRegex = /^[A-Za-z\s]+$/; // Regex for only letters and spaces

  if (!cardNameRegex.test(cardName)) {
      alert('Invalid name. Please enter only letters.');
      return false;
  }

  if (!cardNumberRegex.test(cardNumber)) {
      alert('Invalid card number. Please enter a 16-digit number.');
      return false;
  }

  if (!expiryDateRegex.test(expiryDate)) {
      alert('Invalid expiry date. Please enter in MMYY format.');
      return false;
  }

  if (!cvvRegex.test(cvv)) {
      alert('Invalid CVV. Please enter a 3-digit number.');
      return false;
  }

  return true;
}

// Restrict input for card number and CVV to digits only
document.getElementById('cardNumber').addEventListener('input', function(e) {
  this.value = this.value.replace(/\D/g, '');
});

document.getElementById('cvv').addEventListener('input', function(e) {
  this.value = this.value.replace(/\D/g, '');
});

// Restrict input for card name to letters and spaces only
document.getElementById('cardName').addEventListener('input', function(e) {
  this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

// Restrict input for expiry date to 4 digits only
document.getElementById('expiryDate').addEventListener('input', function(e) {
  this.value = this.value.replace(/\D/g, '').slice(0, 4);
});
