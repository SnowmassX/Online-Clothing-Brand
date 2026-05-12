function validateForm() {

    let name = document.getElementById('name').value.trim();
    let email = document.getElementById('email').value.trim();
    let password = document.getElementById('password').value.trim();
    let address = document.getElementById('address').value.trim();
    let phone = document.getElementById('phone').value.trim();
    let image = document.getElementById('image').value;

    let msg = document.getElementById('error');

    if (name === "" || email === "" || password === "" || address === "" || phone === "" || image === "") {
        msg.innerHTML = "All fields including image are required";
        return false;
    }

    if (password.length < 8) {
        msg.innerHTML = "Password must be at least 8 characters";
        return false;
    }

    if (phone.length !== 11) {
        msg.innerHTML = "Phone must be exactly 11 digits";
        return false;
    }

    for (let i = 0; i < phone.length; i++) {
        if (phone[i] < '0' || phone[i] > '9') {
            msg.innerHTML = "Phone must contain numbers only";
            return false;
        }
    }

    let allowed = [".jpg", ".jpeg", ".png", ".gif"];
    let validImage = false;

    for (let i = 0; i < allowed.length; i++) {
        if (image.endsWith(allowed[i])) {
            validImage = true;
            break;
        }
    }

    if (!validImage) {
        msg.innerHTML = "Only JPG, JPEG, PNG, GIF allowed";
        return false;
    }

    error.innerHTML = "";
    return true;
}