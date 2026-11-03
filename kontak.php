<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kontak - LaundryKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .hero { 
        /* Hanya menampilkan foto tanpa lapisan ungu */
        background-image: url('images/ungu.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white; 
        padding: 100px 0; 
        /* Menambahkan bayangan hitam tipis pada teks agar tetap terbaca di atas foto */
        text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
    }
    .btn-primary { background-color: #9575cd; border-color: #9575cd; }
    .btn-primary:hover { background-color: #7e57c2; }
    .card { border-radius: 15px; }
</style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #ffffff;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="color: #bc9bf7; font-weight: bold;">LaundryKu</a>
        <img src="images/logo.avif" alt="Logo" width="35" height="35" class="me-2" style="border-radius: 50%;">
            
        
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php" style="color: #bc9bf7; font-weight: 500;">Beranda</a>
            <a class="nav-link" href="tentang.php" style="color: #bc9bf7; font-weight: 500;">Tentang</a>
            <a class="nav-link" href="layanan.php" style="color: #bc9bf7; font-weight: 500;">Layanan</a>
            <a class="nav-link" href="galeri.php" style="color: #bc9bf7; font-weight: 500;">Galeri</a>
            <a class="nav-link" href="kontak.php" style="color: #694d99; font-weight: 500;">Kontak</a>
            <a class="nav-link" href="logout.php" style="color: #bc9bf7; font-weight: 500;">Logout</a>
            
            <?php if(isset($_SESSION['status']) && $_SESSION['role'] == "admin"): ?>
                <a class="nav-link" href="logout.php" style="color: #bc9bf7; font-weight: 500;">Logout</a>
            <?php else: ?>
            
            <?php endif; ?>
        </div>
    </div>
</nav>


    <section class="hero text-center mb-5">
        <div class="container">
            <h1>Hubungi Kami</h1>
            <p>Ada pertanyaan? Silakan hubungi kami melalui saluran berikut</p>
        </div>
    </section>

    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card contact-card p-4 shadow-sm text-center border-0">
                    <h5>WhatsApp</h5>
                    <p class="text-muted">0812-2707-2006</p>
                    <a href="https://wa.me/6281227072006" class="btn btn-outline-success">Chat WhatsApp</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card contact-card p-4 shadow-sm text-center border-0">
                    <h5>Lokasi</h5>
                    <p class="text-muted">Kamang Magek, Sumatera Barat</p>
                    <a href="https://share.google/kBzBX5MDIh0BpKKre" class="btn btn-outline-primary">Lihat Peta</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card contact-card p-4 shadow-sm text-center border-0">
                    <h5>Jam Operasional</h5>
                    <p class="text-muted">Senin - Sabtu: 08.00 - 23.00</p>
                    <p class="text-muted">Minggu: Libur</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>