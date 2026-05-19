var searchBtn   = document.getElementById('searchBtn');
var searchInput = document.getElementById('searchInput');

searchBtn.addEventListener('click', function() {
    var q = searchInput.value.trim();
    if (q != '') {
        window.location.href = 'search_results.php?q=' + encodeURIComponent(q);
    } else {
        window.location.href = 'search_results.php';
    }
});

searchInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        var q = searchInput.value.trim();
        if (q != '') {
            window.location.href = 'search_results.php?q=' + encodeURIComponent(q);
        } else {
            window.location.href = 'search_results.php';
        }
    }
});
