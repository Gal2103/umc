<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $query = $conn->prepare("SELECT * FROM pasien WHERE nik = ?");
    $query->bind_param('s', $nik);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $pasien = $result->fetch_assoc();
        echo "Pasien ditemukan: " . $pasien['nama'];
    } else {
        echo "Data pasien tidak ditemukan. Silakan daftar pasien.";
    }
}
?>
<form method="POST">
    <input type="text" name="nik" placeholder="Masukkan NIK">
    <button type="submit">Cek Pasien</button><br>
    <a href="halaman_admin.php">Kembali</a>
</form>