<<<<<<< HEAD
<<<<<<< HEAD
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
=======
document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", function (event) {
            var address = document.getElementsByName("address")[0].value.trim();
=======
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    var paymentMethod = document.querySelector('input[name="payment_method"]:checked');
    var errorEl       = document.getElementById('payment-error');
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)

    if (!paymentMethod) {
        e.preventDefault();
        errorEl.textContent = 'Please select a payment method.';
        return false;
    }
<<<<<<< HEAD
});
>>>>>>> 1b4c921 (backup my checkout and payment work)
=======

    errorEl.textContent = '';
});
>>>>>>> e0ea6a1 (Fixed task 4 checkout and order system integration issues)
