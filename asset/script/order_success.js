document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('order_id');

    const orderIdElement = document.getElementById('display-order-id');

    if (orderId) {
        orderIdElement.textContent = "#" + orderId;
    } else {
        orderIdElement.textContent = "N/A (Check Profile)";
    }
});