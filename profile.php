<?php
// Memulai sesi
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Sertakan koneksi database
include 'db_connection.php';

// Ambil data pengguna dari database berdasarkan sesi
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        echo "Pengguna tidak ditemukan.";
        exit();
    }
} catch (PDOException $e) {
    die("Terjadi kesalahan: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Halaman Profil */
        html, body {
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .profile-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            height: 100%;
            background: url('asset/profile.jpg') no-repeat center center/cover; /* Tambahkan gambar sebagai background */
        }

        /* Kontainer Profil */
        .profile-container {
            width: 90%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Shadow lebih halus */
            text-align: center;
        }

        .profile-container h2 {
            font-size: 26px;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-container p {
            font-size: 18px;
            color: #555;
            margin: 15px 0;
        }

        .profile-container a {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 24px;
            background-color: rgb(10, 10, 10); /* Warna tombol */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .profile-container a:hover {
            background-color: rgb(30, 30, 30); /* Warna tombol saat hover */
        }
    </style>
</head>
<body>
<div class="profile-page">
    <div class="profile-container">
        <h2>Profil Pengguna</h2>
        <p><strong>Nama:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Terdaftar Sejak:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
        <a href="edit_profile.php">Edit Profil</a>
        <a href="logout.php">Logout</a>
        <a href="order.php">Lihat Pemesanan</a>
    </div>
</div>
</body>
</html>
