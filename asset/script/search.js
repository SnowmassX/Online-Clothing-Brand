var searchInput    = document.getElementById('search-input');
var genderFilter   = document.getElementById('gender-filter');
var categoryFilter = document.getElementById('category-filter');
var searchBtn      = document.getElementById('search-btn');
var productGrid    = document.getElementById('product-grid');
var resultCount    = document.getElementById('result-count');

var typingTimer = null;

function getUrlParam(name) {
    var params = new URLSearchParams(window.location.search);
    return params.get(name) || '';
}

function fetchProducts() {
    var q        = searchInput.value.trim();
    var gender   = genderFilter.value;
    var category = categoryFilter.value;

    var url = '../controller/SearchController.php?q=' + encodeURIComponent(q)
            + '&gender='   + encodeURIComponent(gender)
            + '&category=' + encodeURIComponent(category);

    productGrid.innerHTML = '<p class="loading-msg">Loading...</p>';
    resultCount.textContent = '';

    fetch(url)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data.success == false) {
                productGrid.innerHTML = '<p class="error-msg">Something went wrong.</p>';
                return;
            }
            showProducts(data.products);
        })
        .catch(function(error) {
            productGrid.innerHTML = '<p class="error-msg">Could not load products. Please try again.</p>';
        });
}

function showProducts(products) {
    if (products.length == 0) {
        productGrid.innerHTML = '<p class="empty-msg">No products found.</p>';
        resultCount.textContent = '';
        return;
    }

    resultCount.textContent = products.length + ' product(s) found';

    var html = '';

    for (var i = 0; i < products.length; i++) {
        var p = products[i];

        var imgSrc = '../asset/img/no-image.jpg';
        if (p.image_path != '' && p.image_path != null) {
            imgSrc = '../public/uploads/products/' + p.image_path;
        }

        var stockHtml = '';
        if (p.stock == 0) {
            stockHtml = '<span class="out-of-stock">Out of Stock</span>';
        }

        html += '<a class="product-card" href="product_detail.php?id=' + p.id + '">';
        html +=     '<img src="' + imgSrc + '" alt="' + p.name + '">';
        html +=     '<div class="card-body">';
        html +=         '<div class="card-name">' + p.name + '</div>';
        html +=         '<div class="card-meta">' + p.gender + ' - ' + p.category_name + '</div>';
        html +=         '<div class="card-price">Tk ' + p.price + '</div>';
        html +=         stockHtml;
        html +=     '</div>';
        html += '</a>';
    }

    productGrid.innerHTML = html;
}

searchBtn.addEventListener('click', function() {
    fetchProducts();
});

searchInput.addEventListener('keyup', function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(function() {
        fetchProducts();
    }, 500);
});

searchInput.addEventListener('keydown', function() {
    clearTimeout(typingTimer);
});

genderFilter.addEventListener('change', function() {
    fetchProducts();
});

categoryFilter.addEventListener('change', function() {
    fetchProducts();
});

var urlQ      = getUrlParam('q');
var urlGender = getUrlParam('gender');

if (urlQ != '') {
    searchInput.value = urlQ;
}

if (urlGender == 'Men' || urlGender == 'Women') {
    genderFilter.value = urlGender;
}

fetchProducts();