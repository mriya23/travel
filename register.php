<?php
// Memulai sesi
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Arahkan ke halaman utama jika sudah login
    exit();
}

// Variabel pesan error
$error = "";

// Proses registrasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connection.php'; // Sertakan file koneksi database

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        try {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Simpan data pengguna ke database
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);

            // Arahkan ke halaman login setelah berhasil registrasi
            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            // Tangani error duplikasi username atau email
            if ($e->getCode() == 23000) {
                $error = "Username atau email sudah terdaftar.";
            } else {
                $error = "Terjadi kesalahan: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Halaman Register */
        body, html {
            height: 100%;
            background: url('asset/ticket form.jpg') no-repeat center center/cover; /* Tambahkan gambar sebagai background */
            font-family: Arial, sans-serif;
        }

        .register-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%; /* Pastikan elemen memenuhi tinggi layar */
        }

        /* Kontainer Form Register */
        .register-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Shadow lebih lembut */
            border-radius: 12px;
            text-align: center;
        }

        /* Heading */
        .register-container h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #333;
        }

        /* Input Form */
        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"] {
            width: 100%; /* Lebar 100% untuk keselarasan */
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px; /* Sudut membulat */
            font-size: 16px;
        }

        /* Tombol Register */
        .register-container button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color:rgb(3, 3, 3);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Link ke Login */
        .register-container .login-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            color:rgb(8, 8, 8);
            text-decoration: none;
        }

        .register-container .login-link:hover {
            text-decoration: underline;
        }

        /* Pesan Error */
        .error {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .register-container {
                padding: 20px;
            }

            .register-container h2 {
                font-size: 22px;
            }

            .register-container input,
            .register-container button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="register-page">
    <div class="register-container">
        <h2>Register</h2>
        <!-- Tampilkan pesan error jika ada -->
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
            <a href="login.php" class="login-link">Sudah punya akun? Login di sini</a>
        </form>
    </div>
</div>
</body>
</html>
