<?php
// Memulai sesi
session_start();

// Sertakan koneksi database
include 'db_connection.php';

// Proses form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $destinasi = htmlspecialchars($_POST['destinasi']);
    $jumlah_tiket = intval($_POST['jumlah_tiket']);

    // Validasi data
    if (empty($nama) || empty($email) || empty($destinasi) || $jumlah_tiket < 1) {
        echo "Semua data harus diisi dengan benar.";
        exit();
    }

    // Hitung total harga (misal: Rp 250.000 per tiket)
    $harga_per_tiket = 250000;
    $total_harga = $jumlah_tiket * $harga_per_tiket;

    // Simpan ke database
    try {
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, destinasi, jumlah_tiket, total_harga) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $destinasi, $jumlah_tiket, $total_harga]);

        // Redirect ke halaman sukses
        header("Location: ticket_success.php");
        exit();
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
        exit();
    }
} else {
    // Redirect ke form jika bukan metode POST
    header("Location: ticket_form.php");
    exit();
}
?>
