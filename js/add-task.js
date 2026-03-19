const openBtn = document.getElementById("add-task");
const closeBtn = document.getElementById("close-Popup");
const modal = document.getElementById("add-task-popup");

openBtn.addEventListener("click", (e) => {
    e.preventDefault();
    modal.classList.remove("hidden");
});

closeBtn.addEventListener("click", () => {
    modal.classList.add("hidden");
});



// Fungsi Validasi
document.querySelector('.add-task-popup form').addEventListener('submit', function(e) {
    const judul = document.getElementById('judul').value;
    const deskripsi = document.getElementById('deskripsi').value;
    const prioritas = document.getElementById('prioritas').value;

    if (!judul || !deskripsi || !prioritas) {
        e.preventDefault(); // Mencegah form dikirim
        alert("Semua field harus diisi!");
    }
});

// Kalau tombol tambah tugas dipencet (Kondisi nya berhasil terkirim) maka akan langsung menutup popup
document.getElementById('show-add-task-popup').addEventListener('click', function() {
    document.getElementById('add-task-popup').classList.remove('hidden');
});