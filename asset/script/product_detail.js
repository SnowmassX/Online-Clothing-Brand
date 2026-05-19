var addToCartBtn  = document.getElementById('add-to-cart-btn');
var quantityInput = document.getElementById('quantity-input');
var minusBtn      = document.getElementById('minus-btn');
var plusBtn       = document.getElementById('plus-btn');
var quantityError = document.getElementById('quantity-error');
var cartMessage   = document.getElementById('cart-message');

var stock = 0;
if (addToCartBtn != null) {
    stock = parseInt(addToCartBtn.getAttribute('data-stock'));
}

if (minusBtn != null) {
    minusBtn.addEventListener('click', function() {
        var current = parseInt(quantityInput.value);
        if (current > 1) {
            quantityInput.value = current - 1;
            quantityError.textContent = '';
        }
    });
}

if (plusBtn != null) {
    plusBtn.addEventListener('click', function() {
        var current = parseInt(quantityInput.value);
        if (current < stock) {
            quantityInput.value = current + 1;
            quantityError.textContent = '';
        } else {
            quantityError.textContent = 'Cannot exceed available stock (' + stock + ')';
        }
    });
}

if (quantityInput != null) {
    quantityInput.addEventListener('change', function() {
        var val = parseInt(quantityInput.value);

        if (isNaN(val) || val < 1) {
            quantityInput.value = 1;
            quantityError.textContent = 'Quantity must be at least 1';
            return;
        }

        if (val > stock) {
            quantityInput.value = stock;
            quantityError.textContent = 'Cannot exceed available stock (' + stock + ')';
            return;
        }

        quantityError.textContent = '';
    });
}

if (addToCartBtn != null) {
    addToCartBtn.addEventListener('click', function() {
        var productId = addToCartBtn.getAttribute('data-product-id');
        var quantity  = parseInt(quantityInput.value);

        quantityError.textContent = '';
        cartMessage.textContent   = '';
        cartMessage.className     = 'cart-message';

        if (isNaN(quantity) || quantity < 1) {
            quantityError.textContent = 'Please enter a valid quantity';
            return;
        }

        if (quantity > stock) {
            quantityError.textContent = 'Cannot exceed available stock (' + stock + ')';
            return;
        }

        addToCartBtn.textContent  = 'Adding...';
        addToCartBtn.disabled     = true;

        fetch('../controller/CartController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'action=add&product_id=' + productId + '&quantity=' + quantity
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data.success == true) {
                cartMessage.textContent = 'Added to cart successfully!';
                cartMessage.classList.add('success');

                var cartBadge = document.getElementById('cart-count');
                if (cartBadge != null) {
                    cartBadge.textContent = data.cart_count;
                }
            } else {
                if (data.error == 'not_logged_in') {
                    cartMessage.textContent = 'Please login to add items to cart';
                    cartMessage.classList.add('error');
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 1500);
                } else {
                    cartMessage.textContent = data.error;
                    cartMessage.classList.add('error');
                }
            }

            addToCartBtn.textContent = 'Add to Cart';
            addToCartBtn.disabled    = false;
        })
        .catch(function(error) {
            cartMessage.textContent = 'Something went wrong. Please try again.';
            cartMessage.classList.add('error');
            addToCartBtn.textContent = 'Add to Cart';
            addToCartBtn.disabled    = false;
        });
    });
}
