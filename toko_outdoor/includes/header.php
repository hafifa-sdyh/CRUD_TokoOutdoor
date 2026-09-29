<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/database.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdventureGear - Toko Alat Outdoor</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <a href="index.php" class="brand">🏕️ AdventureGear</a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="produk.php">Katalog Peralatan</a></li>
                    <li><a href="tentang.php">Tentang Kami</a></li>
                    <?php if (isset($_SESSION['admin'])): ?>
                        <li><a href="admin/index.php" class="btn-nav-login">Dashboard Admin</a></li>
                    <?php else: ?>
                        <li><a href="auth/login.php" class="btn-nav-login">Login Admin</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">