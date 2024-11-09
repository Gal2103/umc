<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $status = $_POST['status'];

    $query = $conn->prepare("INSERT INTO pasien (nik, nama, tempat_lahir, tanggal_lahir, alamat, no_hp, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param('sssssss', $nik, $nama, $tempat_lahir, $tanggal_lahir, $alamat, $no_hp, $status);
    if ($query->execute()) {
        echo "Pasien berhasil didaftarkan!";
    } else {
        echo "Gagal mendaftarkan pasien!";
    }
}
?>
<form method="POST">
    <input type="text" name="nik" placeholder="NIK">
    <input type="text" name="nama" placeholder="Nama">
    <input type="text" name="tempat_lahir" placeholder="Tempat Lahir">
    <input type="date" name="tanggal_lahir">
    <input type="text" name="alamat" placeholder="Alamat">
    <input type="text" name="no_hp" placeholder="No HP">
    <select name="status">
        <option value="Dosen">Dosen</option>
        <option value="Karyawan">Karyawan</option>
        <option value="Mahasiswa">Mahasiswa</option>
        <option value="Umum">Umum</option>
    </select>
    <button type="submit">Daftar Pasien</button><br>
    <a href="halaman_admin.php">Kembali</a>
</form>