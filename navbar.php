<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #ffffff;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="color: #bc9bf7; font-weight: bold;">Laundry</a>
        <img src="images/logo.avif" alt="Logo" width="35" height="35" class="me-2" style="border-radius: 50%;">
            
        
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php" style="color: #bc9bf7; font-weight: 500;">Beranda</a>
            <a class="nav-link" href="tentang.php" style="color: #bc9bf7; font-weight: 500;">Tentang</a>
            <a class="nav-link" href="layanan.php" style="color: #bc9bf7; font-weight: 500;">Layanan</a>
            
            <?php if(isset($_SESSION['status']) && $_SESSION['role'] == "admin"): ?>
                <a class="nav-link" href="admin.php" style="color: #bc9bf7; font-weight: 500;">Dashboard Admin</a>
                <a class="nav-link" href="logout.php" style="color: #bc9bf7; font-weight: 500;">Logout</a>
            <?php else: ?>
                <a class="nav-link" href="login.php" style="color: #bc9bf7; font-weight: 500;">Login Admin</a>
            <?php endif; ?>
        </div>
    </div>
</nav>