<?php session_start(); include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Layanan - LaundryKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero { 
            background-image: url('images/ungu.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white; 
            padding: 100px 0; 
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }
        .btn-primary { background-color: #9575cd; border-color: #9575cd; }
        .btn-primary:hover { background-color: #7e57c2; }
        .card { border-radius: 15px; }
    </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #ffffff;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="color: #bc9bf7; font-weight: bold;">LaundryKu</a>
        <img src="images/logo.avif" alt="Logo" width="35" height="35" class="me-2" style="border-radius: 50%;">
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php" style="color: #bc9bf7; font-weight: 500;">Beranda</a>
            <a class="nav-link" href="tentang.php" style="color: #bc9bf7; font-weight: 500;">Tentang</a>
            <a class="nav-link" href="layanan.php" style="color: #694d99; font-weight: 700;">Layanan</a>
            <a class="nav-link" href="galeri.php" style="color: #bc9bf7; font-weight: 500;">Galeri</a>
            <a class="nav-link" href="kontak.php" style="color: #bc9bf7; font-weight: 500;">Kontak</a>
            <a class="nav-link" href="logout.php" style="color: #bc9bf7; font-weight: 500;">Logout</a>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero text-center mb-5">
    <div class="container">
        <h1>Daftar Layanan</h1>
        <p>Pilihan layanan terbaik untuk kebutuhan pakaian Anda</p>
    </div>
</section>

<div class="container pb-5">
    <div class="row">
        <!-- Daftar Harga -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-4 h-100">
                <h4 class="mb-4">Daftar Harga</h4>
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr><th>Jenis Layanan</th><th class="text-end">Harga</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Reguler-Cuci Kering</td><td class="text-end">Rp 3.000/kg</td></tr>
                        <tr><td>Reguler-Cuci Setrika</td><td class="text-end">Rp 6.000/kg</td></tr>
                        <tr><td>Reguler-Cuci Bed Cover</td><td class="text-end">Rp 15.000/pcs</td></tr>
                        <tr><td>Kilat-Cuci Kering</td><td class="text-end">Rp 6.000/kg</td></tr>
                        <tr><td>Kilat-Cuci Setrika</td><td class="text-end">Rp 10.000/kg</td></tr>
                        <tr><td>Kilat-Cuci Bed Cover</td><td class="text-end">Rp 22.000/pcs</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form Pemesanan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-4 h-100">
                <h4 class="mb-4">Form Pemesanan</h4>
                <form action="proses_pesan.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No.HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Layanan</label>
                        <select name="layanan" class="form-select" required>
                            <option value="1">Reguler - Cuci Kering (Rp 3.000/kg)</option>
                            <option value="2">Reguler - Cuci Setrika (Rp 6.000/kg)</option>
                            <option value="3">Reguler - Cuci Bed Cover (Rp 15.000/pcs)</option>
                            <option value="4">Kilat - Cuci Kering (Rp 6.000/kg)</option>
                            <option value="5">Kilat - Cuci Setrika (Rp 10.000/kg)</option>
                            <option value="6">Kilat - Cuci Bed Cover (Rp 22.000/pcs)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Berat / Jumlah</label>
                        <input type="number" name="berat" class="form-control" placeholder="Kg atau Pcs" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="pembayaran" class="form-select" required>
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </div>
                    <button type="submit" name="pesan" class="btn btn-primary w-100">Kirim Pesanan</button>
                </form>
            </div>
        </div>

        <!-- Form Ulasan -->
        <div class="col-md-12">
            <div class="card shadow-sm p-4" id="ulasanCard">
                <h4 class="mb-4">Beri Ulasan</h4>
                <form id="formUlasan">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Rating:</label>
                            <select name="rating" class="form-select mb-3">
                                <option value="5">5 - Sangat Puas</option>
                                <option value="4">4 - Puas</option>
                                <option value="3">3 - Cukup</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Komentar:</label>
                            <textarea name="komentar" class="form-control mb-3" rows="1" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Kirim Ulasan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Skrip untuk mengubah tampilan form ulasan menjadi ucapan terima kasih tanpa reload halaman
document.getElementById('formUlasan').addEventListener('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch('ulasan.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('ulasanCard').innerHTML = `
            <div class="text-center py-4">
                <h3 class="text-success mb-3">Terima Kasih!</h3>
                <p class="text-muted mb-0">Ulasan Anda berhasil dikirim dan sangat berarti bagi kemajuan layanan LaundryKu.</p>
            </div>
        `;
    })
    .catch(error => {
        alert('Terjadi kesalahan saat mengirim ulasan.');
    });
});
</script>

</body>
</html>