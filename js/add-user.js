const openBtn = document.getElementById("add-task");  // tombol "Tambah"
const closeBtn = document.getElementById("close-Popup");
const overlay = document.getElementById("add-user-popup-overlay");

openBtn.addEventListener("click", (e) => {
    e.preventDefault();
    overlay.classList.add("active");
});

closeBtn.addEventListener("click", () => {
    overlay.classList.remove("active");
});

overlay.addEventListener("click", (e) => {
    if (e.target === overlay) {
        overlay.classList.remove("active");
    }
});
