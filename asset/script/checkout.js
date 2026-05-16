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