document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    var paymentMethod = document.querySelector('input[name="payment_method"]:checked');
    var errorEl       = document.getElementById('payment-error');

    if (!paymentMethod) {
        e.preventDefault();
        errorEl.textContent = 'Please select a payment method.';
        return false;
    }

    errorEl.textContent = '';
});
