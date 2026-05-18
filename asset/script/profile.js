window.onload = function () {
    loadProfile();
    document.getElementById('profile_picture').addEventListener('change', previewImage);
}

function previewImage(e) {
    if (!e.target.files[0]) return;

    let reader = new FileReader();
    reader.onload = function () {
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(e.target.files[0]);
}

function loadProfile() {
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../controller/userController.php", true);
    xhttp.send();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            console.log("loadProfile status:", this.status);
            console.log("loadProfile response:", this.responseText);
        }

        if (this.readyState == 4 && this.status == 200) {
            let user = JSON.parse(this.responseText);
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('phone').value = user.phone;
            document.getElementById('address').value = user.address;

            if (user.profile_picture) {
                document.getElementById('preview').src =
                    "../asset/upload/user/" + user.profile_picture;
            } else {
                document.getElementById('preview').src =
                    "../asset/upload/user/default.png";
            }
        }
    }
}

function updateProfile() {
    let formData = new FormData();
    formData.append("name", document.getElementById('name').value);
    formData.append("email", document.getElementById('email').value);
    formData.append("phone", document.getElementById('phone').value);
    formData.append("address", document.getElementById('address').value);

    let file = document.getElementById('profile_picture').files[0];
    if (file) {
        formData.append("profile_picture", file);
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/updateProfile.php", true);
    xhttp.send(formData);

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            console.log("updateProfile status:", this.status);
            console.log("updateProfile response:", this.responseText);
        }

        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            let message = document.getElementById('message');
            message.className = response.status;
            message.innerHTML = response.message;
            if (response.status == "success" && response.image_path) {
                document.getElementById('preview').src =
                    "../asset/upload/user/" + response.image_path;
            }
        }
    }
}

function changePassword() {
    let data = {
        current_password: document.getElementById('current_password').value,
        new_password: document.getElementById('new_password').value,
        confirm_password: document.getElementById('confirm_password').value
    };

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/changePassword.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(JSON.stringify(data));

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            console.log("changePassword status:", this.status);
            console.log("changePassword response:", this.responseText);
        }

        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            let message = document.getElementById('message');
            message.className = response.status;
            message.innerHTML = response.message;
        }
    }
}