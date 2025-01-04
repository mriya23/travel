<?php
// Memulai sesi
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Redirect ke halaman login jika belum login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Tiket</title>
    <style>
        /* Reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Halaman Form */
        body, html {
            height: 100%;
            background: url('asset/ticket form.jpg') no-repeat center center/cover; /* Tambahkan gambar sebagai background */
            font-family: Arial, sans-serif;
        }

        .form-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%; /* Pastikan form-page memenuhi tinggi layar */
        }

        /* Kontainer Form */
        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Shadow lebih lembut */
            border-radius: 12px; /* Sudut lebih membulat */
        }

        /* Heading */
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 26px;
            color: #333;
        }

        /* Input Form */
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="email"],
        .form-container select {
            width: 100%; /* Lebar 100% untuk keselarasan */
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px; /* Sudut membulat */
            font-size: 16px;
        }

        /* Tombol Submit */
        .form-container button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color:rgb(7, 7, 7);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            .form-container h2 {
                font-size: 22px;
            }

            .form-container input,
            .form-container button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="form-page">
    <div class="form-container">
        <h2>Form Pemesanan Tiket</h2>
        <form action="process_ticket.php" method="POST">
            <!-- Input Nama -->
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <!-- Input Email -->
            <input type="email" name="email" placeholder="Email" required>
            <!-- Pilihan Destinasi -->
            <select name="destinasi" required>
                <option value="" disabled selected>Pilih Destinasi</option>
                <option value="Bali">Bali</option>
                <option value="Yogyakarta">Yogyakarta</option>
                <option value="Raja Ampat">Raja Ampat</option>
                <option value="Labuan Bajo">Labuan Bajo</option>
            </select>
            <!-- Input Jumlah Tiket -->
            <input type="number" name="jumlah_tiket" placeholder="Jumlah Tiket" required min="1">
            <!-- Tombol Submit -->
            <button type="submit">Pesan Tiket</button>
        </form>
    </div>
</div>
</body>
</html>
