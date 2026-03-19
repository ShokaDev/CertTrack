document.addEventListener('DOMContentLoaded', function () {
    const filterLinks = document.querySelectorAll('.filter-link');
    const users = document.querySelectorAll('.user-item');

    function filterUsers(filter) {
        users.forEach(user => {
            // Mengambil role dari kelas user-item
            const isAdmin = user.classList.contains('admin');
            const isMember = user.classList.contains('member');

            if (filter === 'all') {
                user.classList.remove('hidden'); // Tampilkan semua pengguna
            } else if (filter === 'admin' && isAdmin) {
                user.classList.remove('hidden'); // Tampilkan hanya admin
            } else if (filter === 'member' && isMember) {
                user.classList.remove('hidden'); // Tampilkan hanya member
            } else {
                user.classList.add('hidden'); // Sembunyikan pengguna yang tidak sesuai
            }
        });
    }

    filterLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah perilaku default link
            filterLinks.forEach(l => l.classList.remove('active')); // Hapus kelas aktif dari semua link
            this.classList.add('active'); // Tambahkan kelas aktif pada link yang diklik
            const filter = this.getAttribute('data-filter'); // Ambil filter dari data-filter
            filterUsers(filter); // Panggil fungsi filter
        });
    });

    // Tampilkan semua pengguna saat halaman dimuat
    filterUsers('all');
});
