<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "certtrack";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set timezone biar konsisten
date_default_timezone_set("Asia/Jakarta");
?>
