<?php
require_once '../includes/auth.php';
require_once '../config/database.php';

// Hitung total produk menggunakan $koneksi
$q_produk = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM produk");
$total_produk = $q_produk ? mysqli_fetch_assoc($q_produk)['total'] : 0;

// Hitung total kategori
$q_kategori = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kategori");
$total_kategori = $q_kategori ? mysqli_fetch_assoc($q_kategori)['total'] : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - AdventureGear</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        body {
            background-color: #f8fafc;
            color: #1e293b;
        }
        .admin-header {
            background-color: #1a3322;
            color: #ffffff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-header h1 {
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .admin-nav a {
            color: #d1e2d4;
            text-decoration: none;
            margin-left: 15px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .admin-nav a:hover {
            color: #ffffff;
        }
        .admin-nav a.btn-logout {
            background-color: #ef4444;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
        }
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .welcome-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .stat-card h3 {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 8px;
        }
        .stat-card .number {
            font-size: 2rem;
            font-weight: 700;
            color: #1a3322;
        }
        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        .btn-action {
            display: block;
            text-align: center;
            padding: 14px;
            background-color: #1a3322;
            color: white;
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .btn-action:hover {
            background-color: #2d5a3c;
        }
        .btn-action.secondary {
            background-color: #ffffff;
            color: #1a3322;
            border: 1px solid #1a3322;
        }
        .btn-action.secondary:hover {
            background-color: #f1f5f9;
        }
    </style>
</head>
<body>

    <header class="admin-header">
        <h1>🏕️ Admin Panel - AdventureGear</h1>
        <nav class="admin-nav">
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="logout.php" class="btn-logout">Logout</a>
        </nav>
    </header>

    <main class="container">
        <div class="welcome-card">
            <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['admin']['nama_lengkap'] ?? 'Admin'); ?>! 👋</h2>
            <p style="color: #64748b; margin-top: 6px;">Kelola katalog produk, kategori, dan pengaturan toko outdoor Anda melalui halaman ini.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Produk Outdoor</h3>
                <div class="number"><?= $total_produk; ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Kategori</h3>
                <div class="number"><?= $total_kategori; ?></div>
            </div>
        </div>

        <h3 style="margin-bottom: 15px;">Menu Manajemen</h3>
        <div class="action-grid">
            <a href="produk.php" class="btn-action">📦 Kelola Produk</a>
            <a href="tambah.php" class="btn-action secondary">+ Tambah Produk Baru</a>
        </div>
    </main>

</body>
</html>