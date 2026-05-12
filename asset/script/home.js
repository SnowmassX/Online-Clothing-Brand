document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');

    // Simple UI feedback for the search box
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            alert("Search functionality will be implemented in Task 3. You searched for: " + this.value);
        }
    });

    // Optional: Add "Random" feature to featured products
    console.log("Home page loaded. Browsing system active.");
});