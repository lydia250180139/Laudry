<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tentang - LaundryKu</title>
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
<body>

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #ffffff;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="color: #bc9bf7; font-weight: bold;">LaundryKu</a>
        <img src="images/logo.avif" alt="Logo" width="35" height="35" class="me-2" style="border-radius: 50%;">
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php" style="color: #bc9bf7; font-weight: 500;">Beranda</a>
            <a class="nav-link" href="tentang.php" style="color: #694d99; font-weight: 500;">Tentang</a>
            <a class="nav-link" href="layanan.php" style="color: #bc9bf7; font-weight: 700;">Layanan</a>
            <a class="nav-link" href="galeri.php" style="color: #bc9bf7; font-weight: 500;">Galeri</a>
            <a class="nav-link" href="kontak.php" style="color: #bc9bf7; font-weight: 500;">Kontak</a>
            <a class="nav-link" href="logout.php" style="color: #bc9bf7; font-weight: 500;">Logout</a></li>
        </div>
    </div>
</nav>

    <section class="hero text-center">
        <div class="container">
            <h1>Tentang LaundryKu</h1>
            <p>Mengenal lebih dekat layanan kami di Kamang Magek</p>
        </div>
    </section>

    <div class="container my-5">
        <div class="card shadow p-4">
            <h3>Siapa Kami?</h3>
            <p>LaundryKu adalah penyedia jasa laundry profesional yang berlokasi di Kamang Magek. Kami berkomitmen untuk memberikan hasil cucian yang bersih, wangi, dan rapi menggunakan peralatan modern dan deterjen ramah lingkungan.</p>
            <hr>
            <p><strong>Visi Kami:</strong> Menjadi jasa laundry paling terpercaya dan tercepat di seluruh wilayah Kamang Magek dan sekitarnya.</p>
        <div class="col-md-6 text-center">
                <img src="images/mesin 2.png" alt="Tentang Kami" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

</body>
</html>