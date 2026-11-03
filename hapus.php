<?php
include 'koneksi.php';

// Menangkap ID Transaksi dari URL
$id = $_GET['id'];

// Menghapus data dari tabel transaksi
// (Data di tabel 'pembayaran' dan 'ulasan' yang terkait akan otomatis ikut terhapus karena relasi CASCADE)
$query = "DELETE FROM transaksi WHERE id_transaksi = '$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: index.php");
    exit();
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>