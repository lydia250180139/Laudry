<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $user = $_POST['username'];
    $pass = $_POST['password']; // Sebaiknya gunakan password_hash() untuk keamanan tingkat lanjut
    $tanggal = date("Y-m-d");

    $query = "INSERT INTO pelanggan (nama, no_hp, alamat, tanggal_daftar, username, password) 
              VALUES ('$nama', '$hp', '$alamat', '$tanggal', '$user', '$pass')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='login_pelanggan.php';</script>";
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5" style="max-width: 500px;">
    <div class="card p-4 shadow">
        <h3 class="text-center mb-4">Daftar Pelanggan Baru</h3>
        <form method="POST">
            <input type="text" name="nama" class="form-control mb-3" placeholder="Nama Lengkap" required>
            <input type="text" name="no_hp" class="form-control mb-3" placeholder="No HP" required>
            <textarea name="alamat" class="form-control mb-3" placeholder="Alamat"></textarea>
            <input type="text" name="username" class="form-control mb-3" placeholder="Buat Username" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Buat Password" required>
            <button type="submit" name="register" class="btn btn-primary w-100">Daftar Sekarang</button>
            <a href="login_pelanggan.php" class="btn btn-link w-100 mt-2">Sudah punya akun? Login</a>
        </form>
    </div>
</div>