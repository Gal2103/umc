<?php
include 'auth.php';
checkRole(['kasir']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
</head>

<body>
    <h2>Dashboard Kasir</h2>
    <p>Selamat datang</p>
    <a href="pembayaran.php">Pembayaran</a><br>
    <a href="laporan.php">Laporan Transaksi</a><br>
    <a href="logout.php">Logout</a>
</body>

</html>