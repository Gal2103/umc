<?php
include 'auth.php';
include 'db.php';
checkRole(['dokter']);

// Proses saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pasien = $_POST['id_pasien'];
    $hasil_analisa = $_POST['hasil_analisa'];
    $resep_obat = $_POST['resep_obat'];

    // Insert data konsultasi ke database
    $query = $conn->prepare("INSERT INTO konsultasi (tanggal, id_pasien, hasil_analisa, resep_obat) VALUES (NOW(), ?, ?, ?)");
    $query->bind_param('iss', $id_pasien, $hasil_analisa, $resep_obat);

    if ($query->execute()) {
        echo "Konsultasi berhasil disimpan untuk pasien ID $id_pasien!";
    } else {
        echo "Gagal menyimpan konsultasi!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Konsultasi</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h2>Input Konsultasi</h2>
    <form method="POST">
        <h3>Pilih Pasien:</h3>
        <select name="id_pasien" required>
            <option value="">-- Pilih Pasien --</option>
            <?php
            // Mengambil daftar pasien dari database
            $query = "SELECT id_pasien, nik, nama FROM pasien";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($pasien = $result->fetch_assoc()) {
                    echo '<option value="' . $pasien['id_pasien'] . '">' . $pasien['nama'] . ' (NIK: ' . $pasien['nik'] . ')</option>';
                }
            } else {
                echo '<option value="">Tidak ada pasien yang terdaftar</option>';
            }
            ?>
        </select>

        <h3>Hasil Analisa Dokter:</h3>
        <textarea name="hasil_analisa" placeholder="Masukkan hasil analisa dokter" required></textarea>

        <h3>Resep Obat:</h3>
        <textarea name="resep_obat" placeholder="Masukkan resep obat" required></textarea>

        <button type="submit">Simpan Konsultasi</button>
    </form>

    <br>
    <a href="halaman_dokter.php">Kembali ke Dashboard</a>
</body>

</html>