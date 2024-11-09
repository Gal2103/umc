<?php
include 'auth.php';
include 'db.php';
checkRole(['kasir']);

// Mengambil data transaksi bulan ini
$bulan_ini = date('Y-m');
$query = $conn->prepare("
    SELECT t.id_transaksi, t.id_pasien, t.tanggal, t.biaya, p.nama, p.status
    FROM transaksi t
    JOIN pasien p ON t.id_pasien = p.id_pasien
    WHERE DATE_FORMAT(t.tanggal, '%Y-%m') = ?
    ORDER BY t.tanggal DESC
");
$query->bind_param('s', $bulan_ini);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Bulanan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h2>Laporan Transaksi Bulan <?php echo date('F Y'); ?></h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>ID Pasien</th>
                <th>Nama Pasien</th>
                <th>Status</th>
                <th>Tanggal Transaksi</th>
                <th>Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $total_biaya = 0;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id_transaksi']}</td>";
                    echo "<td>{$row['id_pasien']}</td>";
                    echo "<td>{$row['nama']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<td>" . date('d-m-Y H:i', strtotime($row['tanggal'])) . "</td>";
                    echo "<td>" . number_format($row['biaya'], 0, ',', '.') . "</td>";
                    echo "</tr>";

                    $total_biaya += $row['biaya'];
                }

                // Menampilkan total biaya
                echo "<tr>";
                echo "<td colspan='5'><strong>Total Pendapatan</strong></td>";
                echo "<td><strong>Rp " . number_format($total_biaya, 0, ',', '.') . "</strong></td>";
                echo "</tr>";
            } else {
                echo "<tr><td colspan='6'>Tidak ada transaksi untuk bulan ini.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>

</html>