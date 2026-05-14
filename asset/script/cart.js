var removeButtons = document.querySelectorAll('.remove-btn');
var minusButtons  = document.querySelectorAll('.minus-btn');
var plusButtons   = document.querySelectorAll('.plus-btn');
var qtyInputs     = document.querySelectorAll('.qty-input');

function updateCartBadge(count) {
    var badge = document.getElementById('cart-count');
    if (badge != null) {
        badge.textContent = count;
    }
}

function updateTotal(total) {
    var totalEl = document.getElementById('cart-total');
    if (totalEl != null) {
        totalEl.textContent = 'Tk ' + total;
    }
}

function updateSubtotal(productId, subtotal) {
    var subtotalEl = document.getElementById('subtotal-' + productId);
    if (subtotalEl != null) {
        subtotalEl.textContent = 'Tk ' + subtotal;
    }
}

function removeRow(productId) {
    var row = document.getElementById('row-' + productId);
    if (row != null) {
        row.remove();
    }

    var cartItems = document.querySelectorAll('.cart-row');
    if (cartItems.length == 0) {
        var cartItemsBox = document.getElementById('cart-items');
        var cartFooter   = document.querySelector('.cart-footer');
        var cartTitle    = document.querySelector('.cart-title');

        if (cartItemsBox != null) cartItemsBox.remove();
        if (cartFooter != null)   cartFooter.remove();

        var wrapper = document.querySelector('.cart-wrapper');
        var emptyDiv = document.createElement('div');
        emptyDiv.className = 'empty-cart';
        emptyDiv.innerHTML = '<p>Your cart is empty.</p><a href="search_results.php" class="continue-btn">Continue Shopping</a>';
        wrapper.appendChild(emptyDiv);
    }
}

function sendUpdateRequest(productId, quantity) {
    fetch('../controller/CartController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=update&product_id=' + productId + '&quantity=' + quantity
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        if (data.success == true) {
            updateSubtotal(productId, data.subtotal);
            updateTotal(data.total);
            updateCartBadge(data.cart_count);
        } else {
            alert(data.error);
        }
    })
    .catch(function(error) {
        alert('Something went wrong. Please try again.');
    });
}

for (var i = 0; i < minusButtons.length; i++) {
    minusButtons[i].addEventListener('click', function() {
        var productId = this.getAttribute('data-product-id');
        var input     = document.querySelector('.qty-input[data-product-id="' + productId + '"]');
        var current   = parseInt(input.value);

        if (current > 1) {
            input.value = current - 1;
            sendUpdateRequest(productId, current - 1);
        }
    });
}

for (var i = 0; i < plusButtons.length; i++) {
    plusButtons[i].addEventListener('click', function() {
        var productId = this.getAttribute('data-product-id');
        var input     = document.querySelector('.qty-input[data-product-id="' + productId + '"]');
        var stock     = parseInt(input.getAttribute('data-stock'));
        var current   = parseInt(input.value);

        if (current < stock) {
            input.value = current + 1;
            sendUpdateRequest(productId, current + 1);
        } else {
            alert('Cannot exceed available stock (' + stock + ')');
        }
    });
}

for (var i = 0; i < qtyInputs.length; i++) {
    qtyInputs[i].addEventListener('change', function() {
        var productId = this.getAttribute('data-product-id');
        var stock     = parseInt(this.getAttribute('data-stock'));
        var val       = parseInt(this.value);

        if (isNaN(val) || val < 1) {
            this.value = 1;
            sendUpdateRequest(productId, 1);
            return;
        }

        if (val > stock) {
            this.value = stock;
            alert('Cannot exceed available stock (' + stock + ')');
            sendUpdateRequest(productId, stock);
            return;
        }

        sendUpdateRequest(productId, val);
    });
}

for (var i = 0; i < removeButtons.length; i++) {
    removeButtons[i].addEventListener('click', function() {
        var productId = this.getAttribute('data-product-id');

        fetch('../controller/CartController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=remove&product_id=' + productId
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data.success == true) {
                removeRow(productId);
                updateTotal(data.total);
                updateCartBadge(data.cart_count);
            } else {
                alert(data.error);
            }
        })
        .catch(function(error) {
            alert('Something went wrong. Please try again.');
        });
    }.bind(removeButtons[i]));
}
