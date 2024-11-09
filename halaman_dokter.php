<?php
include 'auth.php';
checkRole(['dokter']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter</title>
</head>

<body>
    <h2>Dashboard Dokter</h2>
    <p>Selamat datang</p>
    <a href="konsultasi.php">Hasil Konsultasi</a><br>
    <a href="logout.php">Logout</a>
</body>

</html>