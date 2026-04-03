<?php
session_start();
include ('../config/koneksi.php');

// QUERY FIXED (pakai nama & bet_name)
$query = "
SELECT 
    u.id,
    u.nama,
    u.bet_name,
    u.role,
    GROUP_CONCAT(j.nama SEPARATOR ', ') AS sertifikat
FROM users u
LEFT JOIN sertifikat s ON u.id = s.user_id
LEFT JOIN jenis_sertifikat j ON s.jenis_id = j.id
GROUP BY u.id
ORDER BY u.nama ASC
";

$users = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Users</title>

<link rel="stylesheet" href="../css/style.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
.user-item.header {
    font-weight: bold;
    background: #ddd;
}

.list-users li:nth-child(even){
    background: #f5f5f5;
}

.sertifikat {
    max-width: 300px;
    overflow-wrap: break-word;
}
</style>

</head>

<body>

<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="../img/profil.jpg">
            </span>

            <div class="text header-text">
                <span class="name"><?= $_SESSION['username']; ?></span>
                <span class="profession"><?= $_SESSION['role']; ?></span>
            </div>
        </div>
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
                    <a href="sertifikat.php">
                        <i class='bx bx-task icons'></i>
                        <span class="text nav-text">Certificates</span>
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
        </div>
    </div>
</nav>

<section class="main">

<h1>Users</h1>
<hr class="line">

<!-- HEADER -->
<div class="user-item header">
    <span class="user-number">No</span>
    <span class="username">Operator</span>
    <span class="role">Role</span>
    <span class="sertifikat">Certificates</span>
</div>

<?php if (mysqli_num_rows($users) > 0): ?>
<ul class="list-users">

<?php $no = 1; ?>
<?php while ($u = mysqli_fetch_assoc($users)): ?>

<li class="user-item <?= $u['role'] == 1 ? 'admin' : 'member' ?>">

    <span class="user-number"><?= $no++ ?></span>

    <span class="username">
        <?= htmlspecialchars($u['nama']) ?> 
        <small>(<?= htmlspecialchars($u['bet_name']) ?>)</small>
    </span>

    <span class="role">
        <?= $u['role'] == 1 ? 'Admin' : 'Operator' ?>
    </span>

    <span class="sertifikat">
        <?= $u['sertifikat'] ? htmlspecialchars($u['sertifikat']) : '-' ?>
    </span>

</li>

<?php endwhile; ?>

</ul>
<?php else: ?>
<p>Tidak ada data user.</p>
<?php endif; ?>

</section>

<script src="../js/script.js"></script>

</body>
</html>