<?php
    session_start();
    include ('../config/koneksi.php');
    
    // Ngambil semua tugas
    // $_SESSION['dibuat_oleh'] = $user['id'];     
    $tugas = mysqli_query($conn, "SELECT tasks.*, users.username 
                                FROM tasks 
                                JOIN users ON tasks.dibuat_oleh = users.id 
                                ORDER BY tasks.id DESC");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>

    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
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
                        <a href="todo.php" class="active">
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
    <section class="main todo-main">
        <h1>To Do</h1>
        <hr class="line">
        <div class="form-tambah">
            <ul class="list-ul">
                <li><a href="#" class="filter-link active" data-filter="all">All ToDo</a></li>
                <li><a href="#" class="filter-link" data-filter="pending">Pending</a></li>
                <li><a href="#" class="filter-link" data-filter="done">Completed</a></li>
            </ul>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') : ?>
                <button id="add-task">Tambah</button>
            <?php endif; ?>


        </div>

        <div class="add-task-popup hidden" id="add-task-popup">
            <div class="popup-model">
                <form action="../php/tambah.php" method="POST">
                    <div class="header-popup">
                        <h2>Buat Tugas Baru</h2>
                        <button id="close-Popup" class="close"><i data-feather="x"></i></button>
                    </div>
                    <hr class="line">

                    <label for="judul"><strong>Judul</strong></label> <br>
                    <input type="text" name="judul" id="judul" required autocomplete="none" placeholder="Masukkan judul tugas">
                    <br>

                    <label for="deskripsi"><strong>Deskripsi</strong></label> <br>
                    <textarea name="deskripsi" id="deskripsi" placeholder="Penjelasan..."></textarea>
                    <br>

                    <div class="flex">
                        <div class="space">
                            <label for="prioritas"><strong>Prioritas = </strong></label>
                            <select name="prioritas" id="prioritas" required>
                                <option value="low">Rendah</option>
                                <option value="medium" selected>Menengah</option>
                                <option value="high">Tinggi</option>
                            </select>

                            <!-- <?php session_start(); ?> -->
                            <input type="hidden" name="dibuat_oleh" value="<?= $_SESSION['user_id'] ?>">

                            </div>
                        <br>
    
                        <div class="space">
                            <label for="deadline"><strong>Deadline = </strong></label>
                            <input type="datetime-local" name="deadline" id="deadline">
                        </div>
                        <br>
                    </div>

                    <div class="save-task">
                        <button type="submit" name="submit" class="add-task">Tambah Tugas</button>
                    </div>
                </form>
            </div>
        </div>


        <?php if (mysqli_num_rows($tugas) > 0) : ?>
            <ul class="list-tugas">
                <!-- Mulai dari sini itu menampilan semua isi dalam table Tasks -->
                <?php while ($row = mysqli_fetch_assoc($tugas)) : ?>
                    <li class="task <?= $row['status'] == 'done' ? 'status-done' : 'status-pending' ?>">
                        <div class="header-task">
                                <!-- Judul tugas -->
                                <?= htmlspecialchars($row['judul']) ?>
                            <div class="todo-item">
                                <div class="dibuat-oleh">
                                    <p>
                                        <i class='bx  bxs-user'  ></i> 
                                        <?= htmlspecialchars($row['username']) ?> 
                                    </p>
                                </div>

                                <button class="hamburger-btn"><i data-feather="menu"></i></button>
                                <div class="hamburger-popup hidden">
                                    <ul>
                                        <!-- <li><a href="../php/edit.php?id=<?= $row['id'] ?>">✏️ Edit</a></li> -->
                                        <li><a href="../php/hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')"><i class='bx  bx-trash'  ></i>  Hapus</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <hr class="line">

                        <!-- deskripsi tugas -->
                        <div class="body-task">
                            <?= htmlspecialchars($row['deskripsi']) ?>
                        </div>

                        <div class="footer-task">
                            <!-- Dibuat Oleh dan tombol nyatain selesai nya -->
                            <div class="center">
                                <div class="status">
                                    <?= $row['status'] == 'done' ? 'Selesai' : 'Belum Selesai' ?>
                                </div>
                                <div class="prioritas">
                                    <?= $row['prioritas'] == 'low' ? 'Low' : ($row['prioritas'] == 'medium' ? 'Medium' : 'High') ?>
                                </div>
                            </div>

                            <div class="center">
                                <div class="deadline">
                                    <?= htmlspecialchars($row['deadline']) ?> 
                                </div>
                                <?php if ($row['status'] == 'pending') : ?>
                                    <form method="POST" action="../php/complete.php">
                                        <input type="hidden" name="task_id" value="<?= $row['id']; ?>">
                                        <button type="submit" id="done">Selesaikan</button>
                                    </form>
                                <?php else : ?>
                                    <!-- <p class="status-done">✅ Selesai</p>   -->
                                <?php endif; ?>

                            </div>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p>Belum ada tugas.</p>
        <?php endif; ?>
        
    </section>
    <script src="../js/script.js"></script>
    <script src="../js/add-task.js"></script>
    <script src="../js/filter-todo.js"></script>
    <script src="../js/hamburger-popup.js"></script>                                                                     

    <!-- Icon data feather   -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>