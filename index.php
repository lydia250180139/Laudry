<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LaundryKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .footer-banner { 
            background: #bc9bf7; 
            color: white; 
            padding: 40px; 
            border-radius: 15px; 
        }
        .btn-primary { background-color: #bc9bf7; border-color: #bc9bf7; }
        .btn-primary:hover { background-color: #bc9bf7; }

        .hero-section {
            /* Pastikan file ini ada di folder images */
            background-image: url('images/bg.png'); 
            background-size: contain;         
            background-position: center;    
            background-repeat: no-repeat;
            padding: 300px 0;                
            position: relative;             
            color: #ffff; /* Mengubah warna teks jadi gelap agar terbaca di atas foto */
        }

        /* Lapisan ungu telah dihapus */

        .hero-section .container {
            position: relative;
            z-index: 1;
            /* Memberikan bayangan halus agar teks tetap terbaca */
            text-shadow: 1px 1px 3px rgba(12, 12, 12, 0.8); 
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #ffffff;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="color: #bc9bf7; font-weight: bold;">LaundryKu</a>
        <img src="images/logo.avif" alt="Logo" width="35" height="35" class="me-2" style="border-radius: 50%;">
            
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php" style="color: #bc9bf7; font-weight: 500;">Beranda</a>
            <a class="nav-link" href="tentang.php" style="color: #bc9bf7; font-weight: 500;">Tentang</a>
            <a class="nav-link" href="layanan.php" style="color: #bc9bf7; font-weight: 500;">Layanan</a>
            <a class="nav-link" href="galeri.php" style="color: #bc9bf7; font-weight: 500;">Galeri</a>
            <a class="nav-link" href="kontak.php" style="color: #bc9bf7; font-weight: 500;">Kontak</a>
            
            <?php if(isset($_SESSION['status']) && $_SESSION['role'] == "admin"): ?>
                <a class="nav-link" href="logout.php" style="color: #bc9bf7; font-weight: 500;">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<section class="hero-section text-center">
    <div class="container">
        <h1 class="fw-bold">LaundryKu Bersih, Wangi Dan Rapi!</h1>
        <p>Pergi ke menu "Layanan" untuk mendapatkan layanan kami sekarang!</p>
    </div>
</section>

<div class="container my-5 text-center">
    <h3>Ulasan Pelanggan</h3>
    <textarea class="form-control my-3" rows="3" placeholder="Tulis komentar di sini..."></textarea>
    <button class="btn btn-primary px-4">Kirim Ulasan</button>
</div>

<section class="container mb-5">
    <div class="footer-banner text-center shadow">
        <h3>Jangan Ragu, Pakaian Bersih, Seperti Baru!</h3>
        <p>Dengan harga yang bersahabat, pelayanan ramah, dan hasil cucian yang bersih serta wangi tahan lama.</p>
    </div>
    <h2 class="text-center mt-4">LaundryKu</h2>
</section>

</body>
</html>