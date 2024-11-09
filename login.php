<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk cek user
    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();


    // Memeriksa apakah pengguna ditemukan
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Mengambil data pengguna

    // Meng-hash password yang dimasukkan menggunakan MD5
    $hashed_password = md5($password);

    // Memverifikasi apakah password yang di-hash cocok dengan password yang tersimpan
    if ($hashed_password === $user['password']) {
        // Jika password cocok, simpan informasi pengguna di session
        $_SESSION['user_id'] = $user['id']; // Menyimpan ID pengguna
        $_SESSION['role'] = $user['role'];   // Menyimpan role pengguna

        // Arahkan pengguna ke dashboard berdasarkan role
        switch ($user['role']) {
            case 'admin':
                header("Location: halaman_admin.php");
                break;
            case 'dokter':
                header("Location: halaman_dokter.php");
                break;
            case 'kasir':
                header("Location: halaman_kasir.php");
                break;
            default:
                echo "Role tidak dikenal!";
        }
        exit; // Menghentikan eksekusi setelah redirect
    } else {
        // Jika password salah
        echo "Password salah!";
    }
} else {
    // Jika username tidak ditemukan
    echo "Username tidak ditemukan!";
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Klinik</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </form>
</body>

</html>