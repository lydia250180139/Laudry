<?php
include 'koneksi.php';
// Mengubah semua transaksi dari pelanggan 2 ke pelanggan 1
$sql = "UPDATE transaksi SET id_pelanggan = 1 WHERE id_pelanggan = 2";
if (mysqli_query($koneksi, $sql)) {
    echo "Berhasil! Silakan cek kembali halaman dashboard pelanggan.";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}
?>