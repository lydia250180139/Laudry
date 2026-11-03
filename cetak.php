<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:login.php");
    exit();
}
include 'koneksi.php';

// Menangkap ID Transaksi
$id = $_GET['id'];

// Mengambil data dari 4 tabel sekaligus (transaksi, pelanggan, layanan, pembayaran)
$query = mysqli_query($koneksi, "
    SELECT t.*, p.nama, p.no_hp, l.nama_layanan, pb.total_bayar, pb.metode 
    FROM transaksi t 
    JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
    JOIN layanan l ON t.id_layanan = l.id_layanan 
    LEFT JOIN pembayaran pb ON t.id_transaksi = pb.id_transaksi
    WHERE t.id_transaksi = '$id'
");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Struk - TRX-<?php echo $data['id_transaksi']; ?></title>
    <style>
        /* Desain khusus untuk kertas struk kasir thermal */
        body { font-family: 'Courier New', Courier, monospace; color: #000; background: #fff; margin: 0; padding: 20px; font-size: 14px; }
        .struk-container { width: 100%; max-width: 300px; margin: 0 auto; border: 1px dashed #000; padding: 15px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 1px dashed #000; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0 0; font-size: 12px; }
        .content { margin-bottom: 20px; }
        .content p { margin: 5px 0; display: flex; justify-content: space-between; }
        .total { border-top: 1px dashed #000; padding-top: 10px; font-weight: bold; font-size: 16px; margin-top: 10px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; border-top: 1px dashed #000; padding-top: 10px; }
        
        /* Sembunyikan elemen lain saat diprint */
        @media print {
            body { padding: 0; }
            .struk-container { border: none; }
        }
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
        <div class="navbar-text">0813 (Kontak)</div>
    </div>
</nav>

<div class="struk-container">
    <div class="header">
        <h2>LAUNDRY KITA</h2>
        <p>Admin: <?php echo $_SESSION['nama_admin']; ?></p>
        <p>Tanggal: <?php echo date('d/m/Y', strtotime($data['tanggal_masuk'])); ?></p>
    </div>

    <div class="content">
        <p><span>ID Transaksi</span> <span>: <strong>TRX-<?php echo $data['id_transaksi']; ?></strong></span></p>
        <p><span>Pelanggan</span> <span>: <?php echo $data['nama']; ?></span></p>
        <p><span>No HP</span> <span>: <?php echo $data['no_hp']; ?></span></p>
        <br>
        <p><span>Layanan</span> <span>: <?php echo $data['nama_layanan']; ?></span></p>
        <p><span>Berat</span> <span>: <?php echo $data['berat']; ?> Kg</span></p>
        <p><span>Status</span> <span>: <?php echo $data['status']; ?></span></p>
        <p><span>Pembayaran</span> <span>: <?php echo isset($data['metode']) ? $data['metode'] : '-'; ?></span></p>
        
        <div class="total">
            <p><span>TOTAL</span> <span>Rp <?php echo isset($data['total_bayar']) ? number_format($data['total_bayar'], 0, ',', '.') : '0'; ?></span></p>
        </div>
    </div>

    <div class="footer">
        <p>Terima kasih telah mencuci di tempat kami!</p>
        <p>Harap bawa struk ini saat pengambilan.</p>
    </div>
</div>

<script>
    // Perintah otomatis untuk membuka jendela Print saat halaman dimuat
    window.print();
</script>

</body>
</html>