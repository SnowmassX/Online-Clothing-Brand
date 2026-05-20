document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", function (event) {
            var accountNumber = document.getElementsByName("account_number")[0].value.trim();
            var pin = document.getElementsByName("pin")[0].value.trim();

            if (accountNumber === "") {
                alert("Please enter your Account or Card number.");
                event.preventDefault();
                return false;
            }

            if (pin === "") {
                alert("Please enter your PIN or CVV.");
                event.preventDefault();
                return false;
            }

            return true;
        });
    }
});