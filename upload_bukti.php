<?php
session_start();
include 'koneksi.php';

// Memastikan form dikirim
if (isset($_POST['id_transaksi'])) {
    $id = $_POST['id_transaksi'];
    
    // Konfigurasi upload
    $target_dir = "uploads/";
    $file_asli = $_FILES['bukti']['name'];
    $file_ext = pathinfo($file_asli, PATHINFO_EXTENSION);
    $nama_baru = "bukti_" . $id . "_" . time() . "." . $file_ext;
    $target_file = $target_dir . $nama_baru;

    // Cek apakah file benar-benar gambar
    $check = getimagesize($_FILES['bukti']['tmp_name']);
    if($check !== false) {
        if (move_uploaded_file($_FILES['bukti']['tmp_name'], $target_file)) {
            
            // Simpan nama file ke database
            // Pastikan kolom 'bukti_transfer' ADA di tabel 'transaksi'
            $query = mysqli_query($koneksi, "UPDATE transaksi SET bukti_transfer = '$nama_baru', status = 'Menunggu Verifikasi' WHERE id_transaksi = '$id'");
            
            if ($query) {
                echo "<script>
                        alert('Bukti berhasil dikirim!'); 
                        window.location='cetak_struk.php?id=$id';
                      </script>";
            } else {
                echo "Gagal update database: " . mysqli_error($koneksi);
            }
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "File bukan gambar.";
    }
} else {
    header("location:dashboard_pelanggan.php");
}
?>