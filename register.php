<?php
include 'koneksi.php';

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Ingat: sebaiknya gunakan password_hash() untuk keamanan
    $nama = $_POST['nama'];

    $query = mysqli_query($koneksi, "INSERT INTO pelanggan (username, password, nama) VALUES ('$username', '$password', '$nama')");
    
    if ($query) {
        echo "<script>alert('Berhasil daftar! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Gagal daftar, coba lagi.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f3e5f5; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .reg-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 6px 20px rgba(156, 39, 176, 0.2); width: 350px; }
        .btn-daftar { background-color: #9575cd; color: white; width: 100%; border: none; padding: 10px; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
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

<div class="reg-card text-center">
    <h4 class="text-purple"><strong>Daftar Akun</strong></h4>
    <form action="" method="POST" class="text-start mt-3">
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="daftar" class="btn-daftar">Daftar Sekarang</button>
    </form>
    <p class="mt-3 text-muted">Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>

</body>
</html>