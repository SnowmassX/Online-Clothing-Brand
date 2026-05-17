document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", function (event) {
            var address = document.getElementsByName("address")[0].value.trim();

            if (address === "") {
                alert("Please enter your delivery address.");
                event.preventDefault(); // ফর্ম সাবমিট হতে দেবে না
                return false;
            }
            return true;
        });
    }
});