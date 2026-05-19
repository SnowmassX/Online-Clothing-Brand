function validateSearchInput(value) {
    if (value.length > 100) {
        return 'Search text is too long';
    }
    return '';
}

function validateQuantity(value, stock) {
    var qty = parseInt(value);

    if (isNaN(qty)) {
        return 'Please enter a valid number';
    }

    if (qty < 1) {
        return 'Quantity must be at least 1';
    }

    if (qty > stock) {
        return 'Cannot exceed available stock (' + stock + ')';
    }

    return '';
}

var searchInput = document.getElementById('search-input');
if (searchInput != null) {
    searchInput.addEventListener('input', function() {
        var error = validateSearchInput(this.value);
        var errorEl = document.getElementById('search-error');
        if (errorEl != null) {
            errorEl.textContent = error;
        }
    });
}

var qtyInputs = document.querySelectorAll('.qty-input');
for (var i = 0; i < qtyInputs.length; i++) {
    qtyInputs[i].addEventListener('change', function() {
        var stock = parseInt(this.getAttribute('data-stock'));
        var error = validateQuantity(this.value, stock);
        var productId = this.getAttribute('data-product-id');
        var errorEl = document.getElementById('qty-error-' + productId);
        if (errorEl != null) {
            errorEl.textContent = error;
        }
    });
}

var quantityInput = document.getElementById('quantity-input');
if (quantityInput != null) {
    quantityInput.addEventListener('change', function() {
        var stock   = parseInt(this.getAttribute('max'));
        var error   = validateQuantity(this.value, stock);
        var errorEl = document.getElementById('quantity-error');
        if (errorEl != null) {
            errorEl.textContent = error;
        }
    });
}
