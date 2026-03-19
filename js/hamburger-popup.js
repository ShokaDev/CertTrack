document.querySelectorAll('.hamburger-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        // Tutup popup lain
        document.querySelectorAll('.hamburger-popup').forEach(function(popup) {
            popup.classList.add('hidden');
        });
        // Toggle popup punya tombol ini
        const popup = btn.nextElementSibling;
        popup.classList.toggle('hidden');
    });
});

// Tutup popup jika ngeklik nya di luar
document.addEventListener('click', function() {
    document.querySelectorAll('.hamburger-popup').forEach(function(popup) {
        popup.classList.add('hidden');
    });
});
