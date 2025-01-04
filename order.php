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

// Ambil ID pengguna dari sesi
$user_id = $_SESSION['user_id'];

// Ambil data pesanan dari database
try {
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Terjadi kesalahan: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Tiket</title>
    <style>
        /* Reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Halaman Pesanan Tiket */
        body {
            margin: 0;
            padding: 0;
            background: url('asset/foto login.jpg') no-repeat center center/cover; /* Tambahkan gambar sebagai background */
            font-family: Arial, sans-serif;
            color: #333;
            height: 100%;
        }

        .orders-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            background: rgba(0, 0, 0, 0.5); /* Warna overlay */
        }

        /* Tabel Pesanan */
        .orders-container {
            width: 100%;
            max-width: 900px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        }

        .orders-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        table th {
            background-color: rgb(90, 105, 95);
            color: #fff;
            text-transform: uppercase;
        }

        table tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        table tr:hover {
            background-color: rgb(232, 240, 232);
        }

        /* Tombol Kembali */
        .back-link {
            display: inline-block;
            margin: 20px auto; /* Memusatkan tombol */
            padding: 12px 20px;
            background-color: rgb(90, 105, 95);
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: rgb(70, 85, 75);
        }

        .back-link-container {
            display: flex;
            justify-content: center; /* Memusatkan tombol secara horizontal */
            align-items: center; /* Memastikan berada di tengah */
        }

        .orders-container p {
            text-align: center;
            font-size: 16px;
            color: rgb(90, 105, 95);
        }
    </style>
</head>
<body>
<div class="orders-page">
    <div class="orders-container">
        <h2>Daftar Pesanan Tiket Anda</h2>
        <?php if (!empty($orders)): ?>
            <table>
                <thead>
                <tr>
                    <th>Destinasi</th>
                    <th>Jumlah Tiket</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pemesanan</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['destinasi']); ?></td>
                        <td><?php echo $order['jumlah_tiket']; ?></td>
                        <td>Rp <?php echo number_format($order['total_harga'], 2, ',', '.'); ?></td>
                        <td><?php echo $order['tanggal_pemesanan']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Belum ada pesanan tiket.</p>
        <?php endif; ?>
        <div class="back-link-container">
            <a href="index.html" class="back-link">Kembali ke Halaman Utama</a>
        </div>
    </div>
</div>
</body>
</html>
