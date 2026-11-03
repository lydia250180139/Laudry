<?php
session_start();
include 'koneksi.php';

// Memastikan tombol pesan ditekan
if (isset($_POST['pesan'])) {
    // Mengamankan input dari user
    $nama       = mysqli_real_escape_string($koneksi, trim($_POST['nama'])); 
    $no_hp      = mysqli_real_escape_string($koneksi, trim($_POST['no_hp'])); 
    $id_layanan = mysqli_real_escape_string($koneksi, trim($_POST['layanan']));
    $berat      = mysqli_real_escape_string($koneksi, trim($_POST['berat']));
    $metode     = mysqli_real_escape_string($koneksi, trim($_POST['pembayaran']));
    
    $status = 'Menunggu Pembayaran';
    $tgl    = !empty($_POST['tanggal']) ? mysqli_real_escape_string($koneksi, trim($_POST['tanggal'])) : date('Y-m-d');

    // Validasi data kosong
    if (empty($nama) || empty($no_hp) || empty($id_layanan) || empty($berat) || empty($metode)) {
        echo "<script>alert('Semua data wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // 1. Masukkan data nama dan nomor HP ke tabel pelanggan
    $query_pelanggan = mysqli_query($koneksi, "INSERT INTO pelanggan (nama, no_hp) VALUES ('$nama', '$no_hp')");
    
    if (!$query_pelanggan) {
        echo "Gagal menyimpan data pelanggan: " . mysqli_error($koneksi);
        exit;
    }

    // 2. Ambil ID pelanggan yang baru saja dibuat
    $id_pelanggan = mysqli_insert_id($koneksi);

    // 3. Masukkan data ke tabel transaksi
    $query_transaksi = mysqli_query($koneksi, "INSERT INTO transaksi (id_pelanggan, id_layanan, berat, metode_pembayaran, status, tanggal_masuk) 
                                                VALUES ('$id_pelanggan', '$id_layanan', '$berat', '$metode', '$status', '$tgl')");

    if ($query_transaksi) {
        $id_transaksi_baru = mysqli_insert_id($koneksi);
        // Redirect ke halaman konfirmasi dengan membawa ID transaksi
        echo "<script>window.location='konfirmasi_pesanan.php?id=$id_transaksi_baru';</script>";
    } else {
        echo "Gagal memproses pesanan: " . mysqli_error($koneksi);
    }
} else {
    // Jika tidak menekan tombol pesan, kembalikan ke halaman layanan
    header("location:layanan.php");
    exit;
}
?>