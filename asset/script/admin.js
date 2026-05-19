function checkProductForm(){
    let name = document.getElementById('name').value;
    let description = document.getElementById('description').value;
    let price = document.getElementById('price').value;
    let gender = document.getElementById('gender').value;
    let category = document.getElementById('category_id').value;
    let stock = document.getElementById('stock').value;
    let image = document.getElementById('image').value;

    if(name == ""){
        alert("Product name required!");
        return false;
    }

    if(description == ""){
        alert("Description required!");
        return false;
    }

    if(price == "" || price <= 0){
        alert("Price must be greater than 0!");
        return false;
    }

    if(gender == ""){
        alert("Select gender!");
        return false;
    }

    if(category == ""){
        alert("Select category!");
        return false;
    }

    if(stock == "" || stock < 0){
        alert("Stock cannot be negative!");
        return false;
    }

    if(image != ""){
        let ext = image.split('.').pop().toLowerCase();

        if(ext != "jpg" && ext != "jpeg" && ext != "png"){
            alert("Only JPG and PNG image allowed!");
            return false;
        }
    }

    return true;
}

function filterCategory() {
    let gender = document.getElementById("gender").value;
    let category = document.getElementById("category_id");

    if (!category) {
        return;
    }

    let options = category.options;

    for (let i = 0; i < options.length; i++) {
        let optionGender = options[i].getAttribute("data-gender");

        if (options[i].value == "") {
            options[i].style.display = "block";
        }
        else if (optionGender == gender) {
            options[i].style.display = "block";
        }
        else {
            options[i].style.display = "none";
        }
    }

    category.value = "";
}

function updateOrder(order_id, status){
    let token = document.getElementById('csrf_token').value;

    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "controller/update_order_status.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send("order_id=" + order_id + "&status=" + status + "&csrf_token=" + token);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            let data = JSON.parse(this.responseText);

            alert(data.message);

            if(data.success){
                document.getElementById("status-" + order_id).innerHTML = status;
            }
        }
    }
}