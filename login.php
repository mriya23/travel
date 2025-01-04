<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Arahkan ke halaman utama jika sudah login
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Tampilan Halaman Login */
        body, html {
            height: 100%;
            background: url('asset/ticket form.jpg') no-repeat center center/cover; /* Tambahkan gambar sebagai background */
            font-family: Arial, sans-serif;
        }

        .login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%; /* Pastikan elemen ini memenuhi tinggi layar */
        }

        /* Kontainer Login */
        .login-container {
            width: 100%;
            max-width: 380px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Shadow lebih lembut */
            border-radius: 12px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #333;
            font-weight: bold;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%; /* Lebar 100% untuk keselarasan */
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px; /* Sudut membulat */
            font-size: 16px;
        }

        .login-container button {
            width: 100%; /* Sesuaikan tombol agar lebar penuh */
            padding: 12px;
            margin-top: 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #444;
        }

        .login-container .register-link {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #333;
            text-decoration: none;
        }

        .login-container .register-link:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="login-page">
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        <form action="login_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <a href="register.php" class="register-link">Belum punya akun? Daftar di sini</a>
        </form>
    </div>
</div>
</body>
</html>
