<?php
session_start();
include 'koneksi.php';

$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Cucian - LaundryKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-header th { background-color: #9575cd !important; color: white !important; }
        .btn-purple { background-color: #9575cd; color: white; }
        .btn-purple:hover { background-color: #7e57c2; color: white; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-4 text-center" style="color: #9575cd;">Hasil Pengecekan Status Cucian</h3>
        
        <?php if(!empty($keyword)): ?>
            <table class="table table-bordered table-hover mt-3">
                <thead class="table-header">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>No. HP</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT t.*, p.nama, p.no_hp, l.nama_layanan FROM transaksi t 
                                                    JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
                                                    JOIN layanan l ON t.id_layanan = l.id_layanan 
                                                    WHERE p.no_hp LIKE '%$keyword%' OR t.id_transaksi LIKE '%$keyword%'");
                    
                    if(mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>
                                    <td>TRX-{$row['id_transaksi']}</td>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['no_hp']}</td>
                                    <td>{$row['nama_layanan']}</td>
                                    <td><strong>{$row['status']}</strong></td>
                                    <td>{$row['tanggal_masuk']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center text-muted'>Data cucian tidak ditemukan untuk kata kunci tersebut.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center">Masukkan kata kunci pencarian terlebih dahulu.</div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="dashboard_pelanggan.php" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>