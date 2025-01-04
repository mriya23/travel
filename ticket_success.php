<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Sukses</title>
    <style>
        /* Reset Margin dan Padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Halaman Utama */
        body, html {
            height: 100%;
            background: url('asset/ticket success.jpg') no-repeat center center/cover; /* Tambahkan gambar sebagai background */
            font-family: Arial, sans-serif;
        }

        .success-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%; /* Pastikan elemen memenuhi tinggi layar */
        }

        /* Kontainer Pesan Sukses */
        .success-container {
            text-align: center;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Shadow lebih lembut */
            border-radius: 12px; /* Sudut membulat */
        }

        .success-container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 15px;
        }

        .success-container p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        .success-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color:rgb(3, 3, 3);
            color: #fff;
            text-decoration: none;
            border-radius: 6px; /* Sudut membulat pada tombol */
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .success-container {
                padding: 20px;
            }

            .success-container h2 {
                font-size: 24px;
            }

            .success-container p {
                font-size: 16px;
            }

            .success-container a {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
<div class="success-page">
    <div class="success-container">
        <h2>Pemesanan Berhasil!</h2>
        <p>Terima kasih telah memesan tiket Anda. Selamat menikmati perjalanan!</p>
        <a href="order.php">Lihat Pesanan</a>
    </div>
</div>
</body>
</html>
