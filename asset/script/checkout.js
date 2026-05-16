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
            var paymentMethod = document.querySelector('input[name="payment_method"]:checked');

            if (address === "") {
                alert("Please enter your delivery address.");
                event.preventDefault();
                return false;
            }

            if (!paymentMethod) {
                alert("Please select a payment method.");
                event.preventDefault();
                return false;
            }

            return true;
        });
    }
});
>>>>>>> 1b4c921 (backup my checkout and payment work)
