<?php
session_start();
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST['task_id'];

    $query = "UPDATE tasks SET status = 'done' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Tugas berhasil diselesaikan!";
    } else {
        $_SESSION['message'] = "Gagal menyelesaikan tugas!";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../views/todo.php"); // arahkan balik ke halaman ToDo
    exit();
}
?>
