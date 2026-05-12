function validateForm() {
    const error = document.getElementById('error');
    error.innerHTML = ""; // Reset error message

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const address = document.getElementById('address').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const imageInput = document.getElementById('image');

    if (!name || !email || !password || !address || !phone || imageInput.files.length === 0) {
        error.innerHTML = "All fields are required.";
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

    if (phone.length !== 11) {
        error.innerHTML = "Phone must be exactly 11 digits.";
        return false;
    }

    const validDigits = "0123456789";
    for (let char of phone) {
        if (validDigits.indexOf(char) === -1) {
            error.innerHTML = "Phone must contain numbers only.";
            return false;
        }
    }

    const file = imageInput.files[0];
    const allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
    
    let isTypeAllowed = false;
    for (let type of allowedTypes) {
        if (file.type === type) {
            isTypeAllowed = true;
            break;
        }
    }

    if (!isTypeAllowed) {
        error.innerHTML = "File type not supported. Use JPG, PNG, or GIF.";
        return false;
    }

    return true;
}