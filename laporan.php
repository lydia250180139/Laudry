<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['role'] != "admin") {
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-size: 13px; background-color: #f8f9fa; }
        /* Header ungu untuk judul */
        .header-purple { background: #bc9bf7; color: white; padding: 20px; border-radius: 8px; margin-bottom: 25px; text-align: center; }
        .table thead { background-color: #bc9bf7; color: white; }
        .table thead th { background-color: #bc9bf7 !important; color: white !important; }
        @media print { .d-print-none { display: none; } }
    </style>
</head>
<body class="p-4">
    <div class="container bg-white p-4 shadow-sm rounded">
        
        <!-- Judul dengan latar belakang ungu -->
        <div class="header-purple">
            <h3 class="m-0">Laporan Data Laundry</h3>
        </div>

        <!-- Form Filter -->
        <form method="GET" class="row g-3 mb-4 d-print-none">
            <div class="col-md-4">
                <select name="jenis" class="form-select">
                    <option value="semua">Semua Data</option>
                    <option value="harian" <?php echo (isset($_GET['jenis']) && $_GET['jenis']=='harian') ? 'selected' : ''; ?>>Laporan Harian</option>
                    <option value="bulanan" <?php echo (isset($_GET['jenis']) && $_GET['jenis']=='bulanan') ? 'selected' : ''; ?>>Laporan Bulanan</option>
                    <option value="tahunan" <?php echo (isset($_GET['jenis']) && $_GET['jenis']=='tahunan') ? 'selected' : ''; ?>>Laporan Tahunan</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="date" name="tanggal" class="form-control" value="<?php echo $_GET['tanggal'] ?? date('Y-m-d'); ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn text-white w-100" style="background:#bc9bf7;">Terapkan Filter</button>
            </div>
        </form>

        <?php
        $where = "";
        $tgl = $_GET['tanggal'] ?? date('Y-m-d');
        if(isset($_GET['jenis'])) {
            if($_GET['jenis'] == 'harian') $where = " WHERE DATE(t.tanggal_masuk) = '$tgl'";
            elseif($_GET['jenis'] == 'bulanan') $where = " WHERE MONTH(t.tanggal_masuk) = MONTH('$tgl') AND YEAR(t.tanggal_masuk) = YEAR('$tgl')";
            elseif($_GET['jenis'] == 'tahunan') $where = " WHERE YEAR(t.tanggal_masuk) = YEAR('$tgl')";
        }
        ?>

        <h5>Data Pelanggan</h5>
        <table class="table table-bordered">
            <thead><tr><th>ID</th><th>Nama</th><th>No HP</th></tr></thead>
            <tbody>
                <?php $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                while($d = mysqli_fetch_array($pelanggan)) { ?>
                <tr><td><?php echo $d['id_pelanggan']; ?></td><td><?php echo $d['nama']; ?></td><td><?php echo $d['no_hp'] ?? '-'; ?></td></tr>
                <?php } ?>
            </tbody>
        </table>

        <h5>Data Layanan</h5>
        <table class="table table-bordered">
            <thead><tr><th>ID</th><th>Layanan</th><th>Harga</th></tr></thead>
            <tbody>
                <?php $layanan = mysqli_query($koneksi, "SELECT * FROM layanan");
                while($d = mysqli_fetch_array($layanan)) { ?>
                <tr><td><?php echo $d['id_layanan']; ?></td><td><?php echo $d['nama_layanan']; ?></td><td>Rp <?php echo number_format($d['harga_per_kg'], 0, ',', '.'); ?></td></tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Penambahan Data Admin -->
        <h5>Data Admin</h5>
        <table class="table table-bordered">
            <thead><tr><th>ID</th><th>Username</th><th>Nama Admin</th><th>No HP</th></tr></thead>
            <tbody>
                <?php 
                $cek_tabel_admin = mysqli_query($koneksi, "SHOW TABLES LIKE 'admin'");
                $tabel_adm = (mysqli_num_rows($cek_tabel_admin) > 0) ? "admin" : "user";
                $admin = mysqli_query($koneksi, "SELECT * FROM $tabel_adm");
                if($admin) {
                    while($d = mysqli_fetch_array($admin)) { ?>
                    <tr>
                        <td><?php echo $d['id_admin'] ?? $d['id'] ?? 1; ?></td>
                        <td><?php echo $d['username'] ?? '-'; ?></td>
                        <td><?php echo $d['nama_admin'] ?? $d['nama'] ?? '-'; ?></td>
                        <td><?php echo $d['no_hp'] ?? '-'; ?></td>
                    </tr>
                    <?php } 
                } ?>
            </tbody>
        </table>

        <h5>Data Transaksi</h5>
        <table class="table table-bordered">
            <thead><tr><th>ID</th><th>Pelanggan</th><th>Layanan</th><th>Tanggal Masuk</th><th>Status</th></tr></thead>
            <tbody>
                <?php $transaksi = mysqli_query($koneksi, "SELECT t.*, p.nama, l.nama_layanan FROM transaksi t 
                                                           JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
                                                           JOIN layanan l ON t.id_layanan = l.id_layanan $where");
                while($d = mysqli_fetch_array($transaksi)) { ?>
                <tr><td>TRX-<?php echo $d['id_transaksi']; ?></td><td><?php echo $d['nama']; ?></td><td><?php echo $d['nama_layanan']; ?></td><td><?php echo $d['tanggal_masuk']; ?></td><td><?php echo $d['status']; ?></td></tr>
                <?php } ?>
            </tbody>
        </table>

        <h5>Data Ulasan</h5>
        <table class="table table-bordered">
            <thead><tr><th>ID</th><th>Nama Pelanggan</th><th>Rating</th><th>Komentar</th><th>Tanggal</th></tr></thead>
            <tbody>
                <?php 
                $cek_ulasan = mysqli_query($koneksi, "SHOW TABLES LIKE 'ulasan'");
                if(mysqli_num_rows($cek_ulasan) > 0) {
                    $ulasan = mysqli_query($koneksi, "SELECT u.*, p.nama FROM ulasan u JOIN transaksi t ON u.id_transaksi = t.id_transaksi JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan");
                    while($d = mysqli_fetch_array($ulasan)) { ?>
                    <tr><td><?php echo $d['id_ulasan']; ?></td><td><?php echo $d['nama']; ?></td><td><?php echo $d['rating']; ?></td><td><?php echo $d['komentar']; ?></td><td><?php echo $d['tanggal_ulasan'] ?? '-'; ?></td></tr>
                    <?php } 
                } ?>
            </tbody>
        </table>

        <button onclick="window.print()" class="btn text-white d-print-none mt-3" style="background:#bc9bf7;">Cetak Laporan</button>
    </div>
</body>
</html>