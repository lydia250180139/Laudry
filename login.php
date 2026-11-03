<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $role = $_POST['role'];

    // JIKA ROLE ADALAH PELANGGAN -> Langsung ke Beranda (Tanpa Login)
    if ($role == 'pelanggan') {
        $_SESSION['role'] = "pelanggan";
        header("location:index.php");
        exit;
    } 
    // JIKA ROLE ADALAH ADMIN -> Lakukan pengecekan database
    else if ($role == 'admin') {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);

        $login = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
        
        if(mysqli_num_rows($login) > 0){
            $_SESSION['status'] = "login";
            $_SESSION['role'] = "admin";
            header("location:admin.php"); 
            exit;
        } else {
            echo "<script>alert('Login Admin Gagal! Username atau password salah.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Sistem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f3e5f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 6px 20px rgba(156, 39, 176, 0.2); width: 350px; text-align: center; }
        .btn-masuk { background-color: #bc9bf7; color: white; width: 100%; border: none; padding: 10px; border-radius: 5px; font-weight: bold; }
        .btn-masuk:hover { background-color: #a882f0; }
        .text-purple { color: #bc9bf7; }
    </style>
</head>
<body>

<div class="login-card">
    <h4 class="text-purple"><strong>LaundryKu</strong></h4>
    <p class="text-muted">Login Sistem</p>
    
    <form action="" method="POST">
        <div class="mb-3 text-start">
            <label class="form-label">Login Sebagai</label>
            <select name="role" id="roleSelect" class="form-select">
                <option value="pelanggan">Pelanggan</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="mb-3 text-start" id="usernameField">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="mb-3 text-start" id="passwordField">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" name="login" class="btn-masuk">Masuk</button>
    </form>
    <div class="mt-3">
        <a href="index.php" class="text-purple text-decoration-none">Kembali ke Beranda</a>
    </div>
</div>

<script>
// Logika untuk menyembunyikan input jika memilih pelanggan
const roleSelect = document.getElementById('roleSelect');
const userField = document.getElementById('usernameField');
const passField = document.getElementById('passwordField');

// Sembunyikan saat halaman dimuat (karena defaultnya adalah pelanggan)
userField.style.display = 'none';
passField.style.display = 'none';

roleSelect.addEventListener('change', function() {
    if(this.value === 'pelanggan') {
        userField.style.display = 'none';
        passField.style.display = 'none';
    } else {
        userField.style.display = 'block';
        passField.style.display = 'block';
    }
});
</script>

</body>
</html>