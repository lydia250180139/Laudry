<?php
session_start();
include 'koneksi.php';

$role = $_GET['role'];
$user = $_POST['username'];
$pass = $_POST['password'];

if ($role == "admin") {
    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['status'] = "login";
        header("location:admin.php");
    }
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username='$user' AND password='$pass'");
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['status_pelanggan'] = "login";
        $_SESSION['id_pelanggan'] = $data['id_pelanggan'];
        header("location:dashboard_pelanggan.php");
    }
}
?>