var cardDrop = document.getElementById('card-dropdown');
var activeDropdown;
cardDrop.addEventListener('click', function () {
    var node;
    for (var i = 0; i < this.childNodes.length - 1; i++)
        node = this.childNodes[i];
    if (node.className === 'dropdown-select') {
        node.classList.add('visible');
        activeDropdown = node;
    }
})

window.onclick = function (e) {
    if (e.target.tagName === 'LI' && activeDropdown) {
        if (e.target.innerHTML === 'Master Card') {
            document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/2vbqk5lcpi7hjoc/MasterCard_Logo.svg.png';
            activeDropdown.classList.remove('visible');
            activeDropdown = null;
            e.target.innerHTML = document.getElementById('current-card').innerHTML;
            document.getElementById('current-card').innerHTML = 'Master Card';
        } else if (e.target.innerHTML === 'American Express') {
            document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/f5hyn6u05ktql8d/amex-icon-6902.png';
            activeDropdown.classList.remove('visible');
            activeDropdown = null;
            e.target.innerHTML = document.getElementById('current-card').innerHTML;
            document.getElementById('current-card').innerHTML = 'American Express';
        } else if (e.target.innerHTML === 'Visa') {
            document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/ubamyu6mzov5c80/visa_logo%20%281%29.png';
            activeDropdown.classList.remove('visible');
            activeDropdown = null;
            e.target.innerHTML = document.getElementById('current-card').innerHTML;
            document.getElementById('current-card').innerHTML = 'Visa';
        }
    } else if (e.target.className !== 'dropdown-btn' && activeDropdown) {
        activeDropdown.classList.remove('visible');
        activeDropdown = null;
    }
}

// Sanitize input fields
document.addEventListener('DOMContentLoaded', function () {
    var cardNumberInput = document.querySelector('input[name="card_number"]');
    var cardHolderInput = document.querySelector('input[name="card_holder"]');
    var expiresInput = document.querySelector('input[name="expires"]');
    var cvcInput = document.querySelector('input[name="cvc"]');

    cardNumberInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    cardHolderInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });

    expiresInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9a-zA-Z]/g, '');
    });

    cvcInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});

// Restrict input to digits by using a regular expression filter.
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

// Apply the filter to the Card Number field with a maximum of 16 digits
setInputFilter(document.getElementById("card-number"), function(value) {
  return /^\d{0,16}$/.test(value);
});

// Restrict input to letters for the Card Holder field
setInputFilter(document.getElementById("card-holder"), function(value) {
  return /^[a-zA-Z\s]*$/.test(value);
});

// Apply the filter to the Expires field allowing both numbers and letters
setInputFilter(document.getElementById("expires"), function(value) {
  return /^[0-9a-zA-Z]*$/.test(value);
});

// Apply the filter to the CVC field with a maximum of 3 digits
setInputFilter(document.getElementById("cvc"), function(value) {
  return /^\d{0,3}$/.test(value);
});