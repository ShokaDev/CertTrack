<?php
require_once "inc/db.php";

/* ===== SORTING CONFIG ===== */

$allowedSort = ['bet_name', 'cert_name', 'expired_date'];
$sort = $_GET['sort'] ?? 'expired_date';
$order = $_GET['order'] ?? 'ASC';

if (!in_array($sort, $allowedSort)) {
    $sort = 'expired_date';
}

$order = ($order === 'DESC') ? 'DESC' : 'ASC';

/* ===== QUERY ===== */

$query = "
SELECT 
    users.bet_name,
    users.name,
    certificates.cert_name,
    certificates.expired_date,
    DATEDIFF(certificates.expired_date, CURDATE()) AS days_left
FROM certificates
JOIN users ON certificates.user_id = users.id
ORDER BY $sort $order
";

$result = $conn->query($query);

function getStatus($days)
{
    if ($days < 0) {
        return "<span class='status-expired'>Expired</span>";
    } elseif ($days <= 14) {
        return "<span class='status-warning'>H-{$days}</span>";
    } else {
        return "<span class='status-safe'>Aman</span>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard - CertTrack</title>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2>Sertifikat Mendekati / Melewati Masa Berlaku</h2>

        <table>
            <tr>
                <th>
                    Operator ID
                    <a href="?sort=bet_name&order=ASC">▲</a>
                    <a href="?sort=bet_name&order=DESC">▼</a>
                </th>

                <th>Nama</th>

                <th>
                    Sertifikat
                    <a href="?sort=cert_name&order=ASC">▲</a>
                    <a href="?sort=cert_name&order=DESC">▼</a>
                </th>

                <th>
                    Expired Date
                    <a href="?sort=expired_date&order=ASC">▲</a>
                    <a href="?sort=expired_date&order=DESC">▼</a>
                </th>

                <th>Status</th>
            </tr>


            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['bet_name']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['cert_name']) ?></td>
                    <td><?= $row['expired_date'] ?></td>
                    <td><?= getStatus($row['days_left']) ?></td>
                </tr>
            <?php endwhile; ?>

        </table>
    </div>

</body>

</html>