<?php
    session_start();
    include ('../config/koneksi.php');

    $query = "SELECT id, username, role FROM users";
    $user = mysqli_query($conn, $query);

    $row = [
    'username' => 'johndoe',
    'role' => 'Admin' // bisa juga 'Member'
    ];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="../css/login.css"> -->
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
                        <a href="dashboard.php">
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
                        <a href="users.php" class="active">
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

    <section class="main">
        <h1>Users</h1>
        <hr class="line">
        <div class="user-filter">
            <ul class="list-ul">
                <li><a href="#" class="filter-link active" data-filter="all">All Users</a></li>
                <li><a href="#" class="filter-link" data-filter="admin">Admin</a></li>
                <li><a href="#" class="filter-link" data-filter="member">Member</a></li>
            </ul>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') : ?>
                <button id="add-task">Tambah</button>
            <?php endif; ?>
        </div>

        <div id="add-user-popup-overlay" class="">
            <div id="add-user-popup" class="form-box register">
                <button id="close-Popup" class="close-btn">×</button> <!-- tombol close -->
                <h2>Register</h2> <br>
                <form action="../php/auth.php" method="POST" id="register-form">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="username" required>
                        <label>Username</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <div class="input-box select-box">
                        <span class="icon"><ion-icon name="people-circle-outline"></ion-icon></span>
                        <select name="role" id="role" required>
                            <option value="" disabled selected hidden></option>
                            <option value="1">Admin</option>
                            <option value="2">Member</option>
                        </select>
                        <label>Role</label>
                    </div>
                    <button type="submit" name="register" class="btn">Daftar</button>
                    <!-- <div class="login-register">
                        <p>Sudah punya akun? <a href="#" class="login-link">Masuk</a></p>
                    </div> -->
                </form>
            </div>
        </div>



        <?php if (mysqli_num_rows($user) > 0) : ?>
            <ul class="list-users">
                <?php $no = 1; // Inisialisasi nomor urut ?>
                <?php while ($row = mysqli_fetch_assoc($user)) : ?>
                    <li class="user-item <?= $row['role'] == 'Admin' ? 'admin' : 'member' ?>">
                        <span class="user-number"><?= $no++ ?>. </span>
                        <span class="username"><?= htmlspecialchars($row['username']) ?></span> <!-- Ngambil Nama Username -->
                        <span class="role"><?= htmlspecialchars($row['role']) ?></span> <!-- Ngambil Role -->
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p>Belum ada pengguna.</p>
        <?php endif; ?>
    </section>

    <script src="../js/script.js"></script>
    <script src="../js/add-user.js"></script>
    <script src="../js/filter-users.js"></script>
    <script src="../js/hamburger-popup.js"></script>
</body>
</html>