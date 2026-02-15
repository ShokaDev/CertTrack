<?php
$operator = "Andi";
$id = "OP-001";

$certs = [
    ["Solder", "Pak Budi", "2025-02-10", "2026-02-10"],
    ["Trimming", "Pak Andi", "2025-03-01", "2026-03-01"]
];
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2><?= $operator ?> (<?= $id ?>)</h2>

        <?php foreach ($certs as $c): ?>
            <div class="card">
                <h3><?= $c[0] ?></h3>
                <p>Instructor: <?= $c[1] ?></p>
                <p>Issued: <?= $c[2] ?></p>
                <p>Expired: <?= $c[3] ?></p>
            </div>
        <?php endforeach; ?>
    </div>

</body>

</html>