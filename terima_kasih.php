<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Terima Kasih - LaundryKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f3e5f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card-thanks { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 6px 20px rgba(156, 39, 176, 0.2); width: 400px; text-align: center; }
        .btn-purple { background-color: #9575cd; color: white; border-radius: 20px; font-weight: bold; width: 100%; padding: 10px; border: none; }
        .btn-purple:hover { background-color: #7e57c2; color: white; }
        .text-purple { color: #9575cd; }
    </style>
</head>
<body>

<div class="card-thanks">
    <h2 class="text-purple mb-3"><strong>Terima Kasih!</strong></h2>
    <p class="text-muted mb-4">Ulasan Anda telah berhasil dikirim. Penilaian Anda sangat berarti bagi kemajuan dan pelayanan LaundryKu.</p>
    <a href="dashboard_pelanggan.php" class="btn btn-purple text-decoration-none">Kembali ke Beranda</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>