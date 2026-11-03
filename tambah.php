<?php 
// Sertakan koneksi dan session di sini
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
    <!-- Hubungkan ke style.css yang sudah kita buat agar warna ungu otomatis aktif -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="dashboard_pelanggan.php">
            <img src="images/logo.avif" width="40" class="me-2 rounded-circle"> Laundry
        </a>
        <div class="navbar-nav mx-auto">
            <a class="nav-link" href="dashboard_pelanggan.php">Beranda</a>
            <a class="nav-link" href="#tentang">Tentang</a>
            <a class="nav-link" href="#layanan">Layanan</a>
            <a class="nav-link" href="ulasan.php">Ulasan</a>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') echo '<a class="nav-link" href="laporan.php">Laporan</a>'; ?>
        </div>
        <div class="navbar-text">0813xxxxxxx (Kontak)</div>
    </div>
</nav>

<div class="container mt-5">
    <!-- Kode yang Anda tanyakan diletakkan di sini -->
    <div class="card shadow">
        <div class="card-header text-center text-white">
            <h4>Input Data Transaksi</h4>
        </div>
        <div class="card-body">
            <form action="tambah.php" method="POST">
                <!-- Tambahkan input-input Anda di sini, contoh: -->
                <div class="mb-3">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                
                <!-- Tombol Simpan Anda -->
                <<button type="submit" class="btn btn-primary">Simpan Transaksi</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>