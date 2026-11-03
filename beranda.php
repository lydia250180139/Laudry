<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status'])) { header("location:login.php"); exit; }
$id_pelanggan = $_SESSION['id_pelanggan'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pelanggan - LaundryKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-header th { background-color: #9575cd !important; color: white !important; }
        .btn-purple { background-color: #9575cd; color: white; border-radius: 20px; }
        .btn-purple:hover { background-color: #7e57c2; color: white; }
        .navbar-brand { font-weight: bold; color: #9575cd !important; }
        .hero-section { background: linear-gradient(rgba(149, 117, 205, 0.7), rgba(149, 117, 205, 0.7)), url('images/background_laundry.jpg'); background-size: cover; background-position: center; height: 500px; display: flex; align-items: center; color: white; padding-left: 100px; }
        .banner-section { background: linear-gradient(rgba(149, 117, 205, 0.8), rgba(149, 117, 205, 0.8)); color: white; text-align: center; padding: 60px 0; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="images/logo.avif" alt="Logo" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
            <span>Laundry</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="#laporan">Laporan</a></li>
                
            </ul>
        </div>
    </div>
</nav>

<section id="beranda" class="hero-section">
    <div class="container">
        <h1 style="font-size: 3.5rem; font-weight: bold;">Laundry Bersih,<br>Wangi Dan Rapi!</h1>
        <p>Pergi ke menu 'Layanan' untuk mendapatkan layanan kami sekarang!</p>
    </div>
</section>

<div class="container mt-5" id="riwayat">
    <div class="card shadow p-4">
        <h4>Riwayat Transaksi Saya</h4>
        <table class="table table-striped mt-3">
            <thead class="table-header">
                <tr><th>ID Transaksi</th><th>Layanan</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT t.*, l.nama_layanan FROM transaksi t JOIN layanan l ON t.id_layanan = l.id_layanan WHERE t.id_pelanggan = '$id_pelanggan'");
                while($row = mysqli_fetch_assoc($query)) {
                    echo "<tr><td>TRX-{$row['id_transaksi']}</td><td>{$row['nama_layanan']}</td><td>{$row['status']}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<section id="tentang">
    <div class="banner-section my-5"><h1>Tentang Kami</h1></div>
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-6"><img src="images/foto_mesin.jpg" class="img-fluid rounded shadow" alt="Tentang"></div>
            <div class="col-md-6">
                <h3>Tentang Kami</h3>
                <p>LaundryKu adalah usaha laundry terpercaya yang berdiri sejak tahun 2024, berlokasi di Kec. Kamang Magek, Sumatera Barat. Kami berkomitmen memberikan pelayanan terbaik.</p>
            </div>
        </div>
    </div>
</section>

<section id="layanan" class="container mt-5 mb-5">
    <div class="banner-section mb-5"><h1>Layanan Laundry</h1></div>
    
    <div class="card shadow p-4 mb-5">
        <h3 class="text-center" style="color: #9575cd;">Cek Status Cucian Anda</h3>
        <p class="text-center text-muted">Masukkan No. HP atau ID Transaksi untuk mengetahui status laundry Anda.</p>
        <form action="cek_status.php" method="GET" class="row justify-content-center">
            <div class="col-md-6"><input type="text" name="keyword" class="form-control" placeholder="No HP atau ID Transaksi" required></div>
            <div class="col-md-2"><button type="submit" class="btn btn-purple w-100">Cek Status</button></div>
        </form>
    </div>
<form action="cek_status.php" method="GET" class="row justify-content-center">
    <div class="col-md-6">
        <!-- Pastikan name-nya persis 'keyword' -->
        <input type="text" name="keyword" class="form-control" placeholder="No HP atau ID Transaksi" required>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-purple w-100">Cek Status</button>
    </div>
</form>
    <div class="card shadow p-4">
        <h3 class="text-center" style="color: #9575cd;">Form Pemesanan Layanan</h3>
        <form action="proses_pesan.php" method="POST" class="mt-4">
            <div class="mb-3"><input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required></div>
            <div class="mb-3"><input type="text" name="hp" class="form-control" placeholder="No HP" required></div>
            <div class="mb-3"><textarea name="alamat" class="form-control" placeholder="Alamat Lengkap" required></textarea></div>
            <div class="row">
                <div class="col-md-6 mb-3">
                <select name="layanan" class="form-select" required>
                <option value="">-- Pilih Layanan --</option>
                <?php
                    $q = mysqli_query($koneksi, "SELECT * FROM layanan");
                    while($l = mysqli_fetch_assoc($q)) {
                    echo "<option value='".$l['id_layanan']."'>".$l['nama_layanan']." (Rp ".number_format($l['harga_per_kg'], 0, ',', '.')."/kg)</option>";
                    }
                    ?>
                </select>
                </div>
                <div class="col-md-6 mb-3">
                    <select name="pembayaran" class="form-select" required>
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="Transfer">Transfer</option>
                        <option value="Tunai">Tunai</option>
                    </select>
                </div>
            </div>
            <div class="mb-3"><input type="number" step="0.1" name="berat" class="form-control" placeholder="Berat (Kg)" required></div>
            <button type="submit" name="pesan" class="btn btn-purple w-100">Pesan Sekarang</button>
        </form>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>