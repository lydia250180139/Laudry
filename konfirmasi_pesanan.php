<?php
session_start();
include 'koneksi.php';

// Pastikan ID transaksi ada di URL
if (!isset($_GET['id'])) { header("location:dashboard_pelanggan.php"); exit; }

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT t.*, l.nama_layanan, l.harga_per_kg FROM transaksi t JOIN layanan l ON t.id_layanan = l.id_layanan WHERE t.id_transaksi = '$id'");
$data = mysqli_fetch_assoc($query);

// Mengalikan berat dari tabel transaksi dengan harga_per_kg dari tabel layanan agar akurat
$berat = floatval($data['berat']); 
$harga_satuan = floatval($data['harga_per_kg']); 
$total = $berat * $harga_satuan;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .purple-header { background-color: #9575cd; color: white; padding: 15px; border-radius: 10px 10px 0 0; }
        .card { border: 1px solid #9575cd; border-radius: 10px; }
        .btn-purple { background-color: #9575cd; color: white; }
        .btn-purple:hover { background-color: #7e57c2; color: white; }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="card shadow col-md-8 mx-auto">
        <div class="purple-header text-center">
            <h3>Konfirmasi Pesanan Laundry</h3>
            <p class="mb-0">Terima kasih telah menggunakan layanan kami</p>
        </div>

        <div class="p-4">
            <h5>Detail Pesanan</h5>
            <table class="table table-borderless">
                <tr><td>ID Transaksi</td><td>: TRX-<?php echo $data['id_transaksi']; ?></td></tr>
                <tr><td>Tanggal Masuk</td><td>: <?php echo $data['tanggal_masuk']; ?></td></tr>
                <tr><td>Metode Pembayaran</td><td>: <?php echo $data['metode_pembayaran']; ?></td></tr>
                <tr><td>Berat Laundry</td><td>: <?php echo $data['berat']; ?> Kg</td></tr>
                <tr><td>Jenis Layanan</td><td>: <?php echo $data['nama_layanan']; ?> (Rp <?php echo number_format($harga_satuan, 0, ',', '.'); ?>/kg)</td></tr>
            </table>
            <hr>
            <h4 class="text-end">Total Pembayaran: Rp <?php echo number_format($total, 0, ',', '.'); ?></h4>
            
            <hr class="my-4">
            
            <!-- Kondisi Tampilan Berdasarkan Metode Pembayaran -->
            <?php if ($data['metode_pembayaran'] == 'Transfer') { ?>
                <h5>Instruksi Pembayaran</h5>
                <p>Silakan transfer ke rekening berikut:</p>
                <div class="alert alert-secondary">
                    <strong>Bank BSI - 7210223923 a.n. LaundryKu </strong><br>
                    Jumlah yang harus dibayar: <strong>Rp <?php echo number_format($total, 0, ',', '.'); ?></strong>
                </div>

                <form action="upload_bukti.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
                    <div class="mb-3">
                        <label class="form-label">Upload Bukti Transfer</label>
                        <input type="file" name="bukti" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-purple w-100">Kirim Bukti Transfer</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-info text-center">
                    <h5>Pembayaran Tunai</h5>
                  <p class="mb-0">Silakan lakukan pembayaran secara langsung di kasir saat mengantar atau mengambil cucian Anda sebesar <strong>Rp <?php echo number_format($total, 0, ',', '.'); ?></strong>.</p>
                </div>
                <a href="dashboard_pelanggan.php" class="btn btn-purple w-100">Kembali ke Dashboard</a>
            <?php } ?>

        </div>
    </div>
</div>

</body>
</html>