function validateForm() {
    let email = document.getElementById('email').value.trim();
    let password = document.getElementById('password').value.trim();
    let error = document.getElementById('error');

    if (email === "" || password === "") {
        error.innerHTML = "All fields are required";
        return false;
    }

    if (email.indexOf('@') === -1 || email.indexOf('.') === -1) {
        error.innerHTML = "Invalid email format.";
        return false;
    }

    if (password.length < 8) {
        error.innerHTML = "Password must be at least 8 characters.";
        return false;
    }

    error.innerHTML = "";
    return true;
}