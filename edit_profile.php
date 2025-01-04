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

// Proses pembaruan profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);

    try {
        // Perbarui data pengguna
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $_SESSION['user_id']]);

        // Redirect ke halaman profil setelah berhasil diperbarui
        header("Location: profile.php");
        exit();
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <style>
        /* Reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Halaman Edit Profil */
        html, body {
            height: 100%;
            background: url('asset/profile.jpg') no-repeat center center/cover; /* Tambahkan gambar sebagai background */
            font-family: Arial, sans-serif;
        }

        .edit-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100%;
            padding: 20px; /* Tambahkan padding untuk responsivitas */
        }

        /* Kontainer Edit Profil */
        .edit-container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px; /* Sudut membulat */
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Bayangan lembut */
            text-align: center;
        }

        .edit-container h2 {
            font-size: 26px;
            color: #333;
            margin-bottom: 20px;
        }

        .edit-container input[type="text"],
        .edit-container input[type="email"] {
            width: 100%; /* Lebar penuh */
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px; /* Sudut membulat */
            font-size: 16px;
        }

        .edit-container button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color:rgb(14, 14, 14);
            color: #fff;
            border: none;
            border-radius: 6px; /* Sudut membulat */
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-container a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color:rgb(24, 24, 24);
            font-size: 14px;
        }

        .edit-container a:hover {
            text-decoration: underline;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .edit-container {
                padding: 20px;
            }

            .edit-container h2 {
                font-size: 22px;
            }

            .edit-container input,
            .edit-container button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="edit-page">
    <div class="edit-container">
        <h2>Edit Profil</h2>
        <form action="" method="POST">
            <!-- Input Nama Pengguna -->
            <input type="text" name="username" placeholder="Nama Pengguna" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            <!-- Input Email -->
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <!-- Tombol Simpan -->
            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="profile.php">Kembali ke Profil</a>
    </div>
</div>
</body>
</html>
