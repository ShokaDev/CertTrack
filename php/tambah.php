<?php
session_start();
include '../config/koneksi.php';

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $prioritas = $_POST['prioritas'];
    $deadline = $_POST['deadline'];
    $dibuat_oleh = $_SESSION['user_id']; // ini biar keliatan siapa yang buat tugas baru

    // Validasi input
    if (!empty($judul) && !empty($deskripsi) && !empty($prioritas)) {
        $stmt = $conn->prepare("INSERT INTO tasks (judul, deskripsi, prioritas, deadline, dibuat_oleh) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $judul, $deskripsi, $prioritas, $deadline, $dibuat_oleh);

        // Eksekusi statement
        if ($stmt->execute()) {
            $_SESSION['message'] = "Tugas berhasil ditambahkan!";
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        $_SESSION['message'] = "Semua field harus diisi!";
    }
}

// Tutup koneksi
$conn->close();
header("Location: ../views/todo.php");
exit();
?>
