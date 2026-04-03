<?php
session_start();
include('../config/koneksi.php');

$query = mysqli_query($conn, "
SELECT sertifikat.*, users.nama, jenis_sertifikat.nama AS jenis
FROM sertifikat
JOIN users ON sertifikat.user_id = users.id
JOIN jenis_sertifikat ON sertifikat.jenis_id = jenis_sertifikat.id
ORDER BY tanggal_expired ASC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Certificate</title>

<link rel="stylesheet" href="../css/style.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
.table-container{
    width: 100%;
    overflow-x: auto;
    margin-top:20px;
    background:#fff;
    border-radius:10px;
    padding:20px;
}

table{
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    width:100%;
    border-collapse:collapse;
}

th, td{
    padding:12px;
    border-bottom:1px solid #eee;
    text-align:left;
    padding: 14px 16px;
    border-right: 1px solid #e5e7eb;
}

th:last-child, td:last-child {
    border-right: none;
}

tbody tr:nth-child(even) {
    background-color: #f9fafb;
}

tbody tr:nth-child(odd) {
    background-color: #ffffff;
}

body.dark tbody tr:nth-child(even) {
    background-color: #2a2b2c;
}

body.dark tbody tr:nth-child(odd) {
    background-color: #242526;
}

tbody tr:hover {
    background-color: #e0e7ff;
    transition: 0.2s;
}

body.dark tbody tr:hover {
    background-color: #3a3b3c;
}
th {
    cursor:pointer;
    background-color: #f1f5f9;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
}

.status {
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

.status.expired {
    background-color: #fee2e2;
    color: #dc2626;
}

.status.expired {
    background-color: #fee2e2;
    color: #dc2626;
}

.status.soon {
    background-color: #fef3c7;
    color: #d97706;
}

.active{background:#dcfce7;color:green}
.warning{background:#fef3c7;color:orange}
.expired{background:#fee2e2;color:red}

.search-box{
    padding:8px 15px;
    border-radius:20px;
    border:1px solid #ccc;
    width:250px;
}
</style>

</head>

<body>

<div class="container">

<!-- SIDEBAR (TETAP) -->
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
        <ul class="menu-links">
            <li class="nav-links">
                <a href="dashboard.php">
                    <i class='bx bxs-dashboard icons'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="nav-links">
                <a href="#" class="active">
                    <i class='bx bx-task icons'></i>
                    <span class="text">Certificates</span>
                </a>
            </li>
            <li class="nav-links">
                <a href="users.php">
                    <i class='bx bx-user icons'></i>
                    <span class="text">Users</span>
                </a>
            </li>
        </ul>

        <div class="bottom-content">
            <a href="../php/logout.php">
                <i class='bx bx-log-out icons'></i>
                <span class="text">Logout</span>
            </a>
        </div>
    </div>
</nav>

<!-- MAIN -->
<section class="main">

<div style="display:flex;justify-content:space-between;align-items:center;">
    <h1>Certificates</h1>

    <!-- SEARCH REALTIME -->
    <input type="text" id="searchInput" class="search-box" placeholder="Search operator...">
</div>

<hr class="line">

<div class="table-container">

<table id="certTable">

<thead>
<tr>
<th onclick="sortTable(0)">Operator ⬍</th>
<th onclick="sortTable(1)">Certificate ⬍</th>
<th onclick="sortTable(2)">Valid ⬍</th>
<th onclick="sortTable(3)">Expired ⬍</th>
<th>Status</th>
</tr>
</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($query)){

$today = date("Y-m-d");
$diff = (strtotime($row['tanggal_expired']) - strtotime($today)) / 86400;

if($diff < 0){
    $status="Expired";
    $class="expired";
}elseif($diff <=14){
    $status="Expiring Soon";
    $class="warning";
}else{
    $status="Active";
    $class="active";
}
?>

<tr>
<td><?= $row['nama'] ?></td>
<td><?= $row['jenis'] ?></td>
<td><?= $row['tanggal_berlaku'] ?></td>
<td><?= $row['tanggal_expired'] ?></td>
<td><span class="status <?= $class ?>"><?= $status ?></span></td>
</tr>

<?php } ?>

</tbody>
</table>

</div>

</section>

</div>

<!-- 🔥 SEARCH REALTIME -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function(){
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#certTable tbody tr");

    rows.forEach(row=>{
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});
</script>

<!-- 🔥 SORT -->
<script>
let sortDir = {};

function sortTable(col){
    const table = document.getElementById("certTable");
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.rows);

    sortDir[col] = !sortDir[col];

    rows.sort((a,b)=>{
        let A = a.cells[col].innerText.trim();
        let B = b.cells[col].innerText.trim();

        if(col==2||col==3){
            A = new Date(A);
            B = new Date(B);
        }

        if(A < B) return sortDir[col] ? -1 : 1;
        if(A > B) return sortDir[col] ? 1 : -1;
        return 0;
    });

    tbody.innerHTML = "";
    rows.forEach(row=>tbody.appendChild(row));
}
</script>

</body>
</html>