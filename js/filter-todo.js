// document.addEventListener('DOMContentLoaded', function () {
//     const filterLinks = document.querySelectorAll('.filter-link');
//     const tasks = document.querySelectorAll('.task');
//     const maxVisibleTasks = 12;
//     const showMoreButton = document.getElementById('show-more');
//     let currentFilter = 'all';
//     let currentIndex = 0;

//     function filterTasks(filter) {
//         let visibleCount = 0;
//         tasks.forEach(task => {
//             if (filter === 'all' || task.classList.contains(filter)) {
//                 if (visibleCount < maxVisibleTasks) {
//                     task.classList.remove('hidden-task');
//                     visibleCount++;
//                 } else {
//                     task.classList.add('hidden-task');
//                 }
//             } else {
//                 task.classList.add('hidden-task');
//             }
//         });

//         currentFilter = filter;
//         currentIndex = visibleCount;

//         if (showMoreButton) {
//             if (filter === 'all' && currentIndex < tasks.length) {
//                 showMoreButton.style.display = 'block';
//             } else {
//                 showMoreButton.style.display = 'none';
//             }
//         }
//     }

//     filterLinks.forEach(link => {
//         link.addEventListener('click', function (event) {
//             event.preventDefault();
//             filterLinks.forEach(link => link.classList.remove('active'));
//             this.classList.add('active');
//             const filter = this.getAttribute('data-filter');
//             filterTasks(filter);
//         });
//     });


//     filterTasks('all');
// });

document.addEventListener('DOMContentLoaded', function () {
    const filterLinks = document.querySelectorAll('.filter-link');
    const users = document.querySelectorAll('.task');

    function filterUsers(filter) {
        users.forEach(user => {
            // Mengambil role dari kelas user-item
            const isDone = user.classList.contains('status-done');
            const isPending = user.classList.contains('status-pending');

            if (filter === 'all') {
                user.classList.remove('hidden');
            } else if (filter === 'pending' && isPending) {
                user.classList.remove('hidden');
            } else if (filter === 'done' && isDone) {
                user.classList.remove('hidden');
            } else {
                user.classList.add('hidden');
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
