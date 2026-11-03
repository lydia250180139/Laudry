<?php
session_start();
session_destroy(); // Menghapus semua memori login
header("location:login.php");
?>