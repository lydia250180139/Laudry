<?php
session_start();
include 'koneksi.php';

// Pengecekan keamanan: Hanya admin yang boleh masuk
if (!isset($_SESSION['status']) || $_SESSION['role'] != "admin") {
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-header th { background-color: #bc9bf7 !important; color: white !important; }
        .btn-update { background-color: #bc9bf7; color: white; border: none; }
        .btn-update:hover { background-color: #bc9bf7; color: white; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #ffffff;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="color: #bc9bf7; font-weight: bold;">LaundryKu</a>
        <img src="images/logo.avif" alt="Logo" width="35" height="35" class="me-2" style="border-radius: 50%;">
        <div class="navbar-nav ms-auto">
            <?php if(isset($_SESSION['status']) && $_SESSION['role'] == "admin"): ?>
                <a class="nav-link" href="admin.php" style="color: #bc9bf7; font-weight: 500;">Admin</a>
                <a class="nav-link" href="laporan.php" style="color: #bc9bf7; font-weight: 500;">Laporan</a>
                <a class="nav-link" href="logout.php" style="color: #bc9bf7; font-weight: 500;">Logout</a>
            <?php else: ?>
                <a class="nav-link" href="login.php" style="color: #bc9bf7; font-weight: 500;">Login Admin</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?php
    if (isset($_SESSION['pesan_sukses'])) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ' . $_SESSION['pesan_sukses'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['pesan_sukses']);
    }
    ?>

    <div class="card shadow p-4">
        <h4 class="mb-4">Kelola Pesanan Laundry</h4>
        <table class="table table-bordered table-hover">
            <thead class="table-header">
                <tr>
                    <th>ID Transaksi</th>
                    <th>Pelanggan</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query mengambil data termasuk tanggal_masuk
                $query = mysqli_query($koneksi, "SELECT t.*, p.nama, l.nama_layanan FROM transaksi t 
                                                JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
                                                JOIN layanan l ON t.id_layanan = l.id_layanan");
                
                while($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>
                            <td>TRX-{$row['id_transaksi']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['nama_layanan']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['tanggal_masuk']}</td>
                            <td>
                                <a href='update.php?id={$row['id_transaksi']}' class='btn btn-sm btn-update'>Update</a>
                                <a href='cetak_struk.php?id={$row['id_transaksi']}' target='_blank' class='btn btn-sm btn-secondary'>Cetak</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>