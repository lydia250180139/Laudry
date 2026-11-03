<?php
session_start();
include 'koneksi.php';

// Pastikan ada ID transaksi
if (!isset($_GET['id'])) { header("location:dashboard_pelanggan.php"); exit; }

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT t.*, p.nama, l.nama_layanan, l.harga_per_kg 
                                 FROM transaksi t 
                                 JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
                                 JOIN layanan l ON t.id_layanan = l.id_layanan 
                                 WHERE t.id_transaksi = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) { echo "Data tidak ditemukan."; exit; }

$total = $data['berat'] * $data['harga_per_kg'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran - TRX-<?php echo $data['id_transaksi']; ?></title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; width: 300px; margin: 20px auto; padding: 10px; border: 1px solid #ccc; }
        .center { text-align: center; }
        .left { text-align: left; }
        hr { border-top: 1px dashed #333; margin: 10px 0; }
        h3 { margin: 0; }
        p { margin: 5px 0; font-size: 14px; }
    </style>
</head>
<body onload="window.print()">
    <div class="center">
        <h3>LAUNDRYKu</h3>
        <p>Kec. Kamang Magek</p>
    </div>
    <hr>
    <div class="left">
        <p>ID Transaksi: TRX-<?php echo $data['id_transaksi']; ?></p>
        <p>Tanggal     : <?php echo $data['tanggal_masuk']; ?></p>
    </div>
    <hr>
    <p>Pelanggan   : <?php echo $data['nama']; ?></p>
    <p>Layanan     : <?php echo $data['nama_layanan']; ?></p>
    <p>Berat       : <?php echo $data['berat']; ?> Kg</p>
    <hr>
    <p><strong>Total Bayar: Rp <?php echo number_format($total, 0, ',', '.'); ?></strong></p>
    <hr>
    <p class="center">Terima Kasih telah Laundry di sini!</p>
</body>
</html>