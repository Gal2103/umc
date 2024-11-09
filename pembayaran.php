<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pasien = $_POST['id_pasien'];
    $status = $_POST['status'];
    $biaya = ($status === 'Mahasiswa' || $status === 'Umum') ? 50000 : 0;

    $query = $conn->prepare("INSERT INTO transaksi (id_pasien, biaya, tanggal) VALUES (?, ?, NOW())");
    $query->bind_param('id', $id_pasien, $biaya);
    if ($query->execute()) {
        echo "Pembayaran berhasil diproses!";
    } else {
        echo "Gagal memproses pembayaran!";
    }
}
?>
<form method="POST">
    <input type="text" name="id_pasien" placeholder="ID Pasien">
    <select name="status">
        <option value="Mahasiswa">Mahasiswa</option>
        <option value="Umum">Umum</option>
        <option value="Dosen">Dosen</option>
        <option value="Karyawan">Karyawan</option>
    </select>
    <button type="submit">Proses Pembayaran</button>
</form>