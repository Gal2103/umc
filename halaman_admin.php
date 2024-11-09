<?php
include 'auth.php';
checkRole(['admin']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>
</head>
<body>
    <h2>Dashboard Admin</h2>
    <p>Selamat datang</p>
    <a href="data_pasien.php">Cek Data Pasien</a><br>
    <a href="daftar_pasien.php">Daftar Pasien</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>
