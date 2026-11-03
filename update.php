<?php
session_start();
// Pastikan hanya admin yang bisa akses
if (!isset($_SESSION['status']) || $_SESSION['role'] != "admin") {
    header("location:login.php");
    exit();
}
include 'koneksi.php';

$id = $_GET['id'];

// Ambil data transaksi
$query = mysqli_query($koneksi, "
    SELECT t.*, p.nama, pb.total_bayar 
    FROM transaksi t 
    JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
    LEFT JOIN pembayaran pb ON t.id_transaksi = pb.id_transaksi
    WHERE t.id_transaksi = '$id'
");
$data = mysqli_fetch_assoc($query);

// Jika tombol update ditekan
if (isset($_POST['update'])) {
    $status_baru = $_POST['status'];
    
    // Validasi: Jika status lama sudah 'Diambil', jangan izinkan update
    if ($data['status'] == 'Diambil') {
        echo "<script>alert('Gagal! Pesanan yang sudah Diambil tidak dapat diubah kembali.'); window.location='admin.php';</script>";
        exit();
    }
    
    $query_update = "UPDATE transaksi SET status = '$status_baru' WHERE id_transaksi = '$id'";
    
    if (mysqli_query($koneksi, $query_update)) {
        header("Location: admin.php"); // Kembali ke admin.php, bukan index.php
        exit();
    } else {
        echo "Gagal memperbarui: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Update Status Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f3e5f5; font-family: sans-serif; padding: 20px; }
        .form-container { background: #fff; padding: 30px; border-radius: 12px; max-width: 400px; margin: 50px auto; box-shadow: 0 6px 20px rgba(156, 39, 176, 0.2); }
        label { font-weight: bold; color: #9575cd; margin-bottom: 5px; }
        .btn-update { background: #9575cd; color: #fff; width: 100%; border: none; padding: 10px; border-radius: 5px; font-weight: bold; }
        .btn-update:hover { background: #7e57c2; color: #fff; }
        .info-box { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #9575cd; }
    </style>
</head>
<body>

<div class="form-container">
    <h3 style="color: #9575cd; text-align: center; margin-bottom: 20px;">Update Status</h3>
    
    <div class="info-box">
        <p class="mb-1"><strong>ID:</strong> TRX-<?php echo $data['id_transaksi']; ?></p>
        <p class="mb-1"><strong>Pelanggan:</strong> <?php echo $data['nama']; ?></p>
        <p class="mb-0"><strong>Total:</strong> Rp <?php echo number_format($data['total_bayar'], 0, ',', '.'); ?></p>
    </div>
    
    <form action="update.php?id=<?php echo $id; ?>" method="POST">
        <label>Status Saat Ini:</label>
        <select name="status" class="form-select mb-3" required <?php echo ($data['status'] == 'Diambil') ? 'disabled' : ''; ?>>
            <option value="Menunggu Pembayaran" <?php if($data['status'] == 'Menunggu Pembayaran') echo 'selected'; ?>>Menunggu Pembayaran</option>
            <option value="Proses" <?php if($data['status'] == 'Proses') echo 'selected'; ?>>Proses</option>
            <option value="Pesanan Siap" <?php if($data['status'] == 'Pesanan Siap') echo 'selected'; ?>>Pesanan Siap</option>
            <option value="Selesai" <?php if($data['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
            <option value="Diambil" <?php if($data['status'] == 'Diambil') echo 'selected'; ?>>Diambil</option>
        </select>

        <?php if($data['status'] != 'Diambil'): ?>
            <button type="submit" name="update" class="btn btn-update">Simpan Perubahan</button>
        <?php else: ?>
            <div class="alert alert-warning text-center">Pesanan sudah diambil.</div>
        <?php endif; ?>
        
        <a href="admin.php" class="d-block text-center mt-3" style="color: #9575cd; text-decoration: none;">Kembali</a>
    </form>
</div>

</body>
</html>