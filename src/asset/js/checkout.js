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