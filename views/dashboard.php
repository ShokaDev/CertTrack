<?php
    session_start();
    include ('../config/koneksi.php');

    // Ambil jumlah total tugas
    $total_tasks = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tasks"));

    // Tugas selesai
    $total_done = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tasks WHERE status = 'done'"));

    // Tugas belum selesai
    $total_pending = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tasks WHERE status = 'pending'"));

    // Total users
    $total_users = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../img/profil.jpg" alt="logo">
                </span>

                <div class="text header-text">
                    <span class="name">
                        <?php echo $_SESSION['username']; ?>
                    </span>
                    <span class="profession">
                        <?php echo $_SESSION['role']; ?>
                    </span>
                </div>
            </div>
            <!-- <hr class="line"> -->

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-links">
                        <a href="dashboard.php" class="active">
                            <i class='bx bxs-dashboard icons'></i> 
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-links">
                        <a href="todo.php">
                            <i class='bx bx-task icons'></i>
                            <span class="text nav-text">ToDo List</span>
                        </a>
                    </li>
                    <li class="nav-links">
                        <a href="users.php">
                            <i class='bx bx-user icons'></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>
                </ul>
            </div>
        
            <div class="bottom-content">
                <li class="nav-links">
                    <a href="../php/logout.php">
                        <i class='bx bx-log-out icons'></i>
                        <span class="text nav-text">Log Out</span>
                    </a>
                </li>
                <li class="mode">
                    <!-- <div class="moon-sun">
                        <i class='bx bx-moon icons moon'></i>
                        <i class='bx bx-sun icons sun'></i>
                    </div> -->
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                    <span class="mode-text text">Dark Mode</span>
                </li>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard Content -->
    <section class="main">
        <h1>Dashboard</h1>
        <hr class="line">
        <div class="welcome-box">
            <h2>Selamat datang!</h2>
            <p>Ini adalah dashboard utama untuk mengelola tugas-tugas harian kamu.<br>
            Kamu login sebagai <strong><?php echo $_SESSION['username'] ?? 'Guest'; ?></strong> [<?php echo $_SESSION['role'] ?? 'unknown'; ?>].</p>
        </div>

        <div class="cards">
            <a href="todo.php">
            <div class="card">
                <div class="card-content">
                        <h3>Banyaknya Tugas</h3>
                        <p><?= $total_tasks ?></p>
                    </div>
                    <i class='bx bx-task'></i>
                </div>
            </a>

            <a href="todo.php">
            <div class="card">
                <div class="card-content">
                    <h3>Tugas Selesai</h3>
                    <p><?= $total_done ?></p>
                </div>
                <i class='bx bx-check-circle'></i>
            </div>
            </a>

            <a href="todo.php">
            <div class="card">
                <div class="card-content">
                    <h3>Tugas Belum Selesai</h3>
                    <p><?= $total_pending ?></p>
                </div>
                <i class='bx bx-time'></i>
            </div>
            </a>

            <a href="users.php">
            <div class="card">
                <div class="card-content">
                    <h3>Total Users</h3>
                    <p><?= $total_users ?></p>
                </div>
                <i class='bx bx-user'></i>
            </div>
            </a>

        </div>
    </section>

    <script src="../js/script.js"></script>
</body>
</html>