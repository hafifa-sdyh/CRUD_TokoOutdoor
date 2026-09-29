<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/auth.php';
require_once '../config/database.php';

// Ambil data produk beserta nama kategorinya
$query = "SELECT p.*, k.nama_kategori 
          FROM produk p 
          LEFT JOIN kategori k ON p.kategori_id = k.id 
          ORDER BY p.id DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Admin AdventureGear</title>
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
            min-height: 100vh;
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
            font-size: 1.2rem;
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

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-header h2 {
            font-size: 1.35rem;
            color: #1e293b;
        }

        .btn-add {
            background-color: #1a3322;
            color: #ffffff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background 0.2s;
        }

        .btn-add:hover {
            background-color: #2d5a3c;
        }

        .card-table {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.925rem;
        }

        th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            padding: 14px 16px;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            color: #334155;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f8fafc;
        }

        .img-thumb {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .badge-cat {
            display: inline-block;
            background-color: #e2e8f0;
            color: #334155;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .price-text {
            font-weight: 600;
            color: #1a3322;
        }

        .badge-stock {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            background-color: #dcfce7;
            color: #166534;
        }

        .action-links {
            display: flex;
            gap: 8px;
        }

        .btn-edit {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 6px 12px;
            border-radius: 6px;
            background-color: #eff6ff;
            transition: background 0.2s;
        }

        .btn-edit:hover {
            background-color: #dbeafe;
        }

        .btn-delete {
            color: #dc2626;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 6px 12px;
            border-radius: 6px;
            background-color: #fef2f2;
            transition: background 0.2s;
        }

        .btn-delete:hover {
            background-color: #fee2e2;
        }

        .alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .empty-row {
            text-align: center;
            padding: 40px;
            color: #64748b;
        }
    </style>
</head>
<body>

    <header class="admin-header">
        <h1>🏕️ Admin Panel - AdventureGear</h1>
        <nav class="admin-nav">
            <a href="index.php">Dashboard</a>
            <a href="produk.php" style="color: #ffffff; font-weight: 600;">Kelola Produk</a>
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="logout.php" style="color: #fca5a5;">Logout</a>
        </nav>
    </header>

    <main class="container">
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert-success">
                <?= htmlspecialchars($_SESSION['success']); ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert-error">
                <?= htmlspecialchars($_SESSION['error']); ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="page-header">
            <h2>Daftar Peralatan Outdoor</h2>
            <a href="tambah.php" class="btn-add">+ Tambah Produk Baru</a>
        </div>

        <div class="card-table">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 80px;">Gambar</th>
                        <th>Nama Peralatan</th>
                        <th>Merk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th style="width: 70px;">Stok</th>
                        <th style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <?php if (!empty($row['gambar']) && file_exists('../uploads/produk/' . $row['gambar'])): ?>
                                        <img src="../uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" class="img-thumb" alt="Produk">
                                    <?php else: ?>
                                        <img src="../assets/no-image.png" class="img-thumb" alt="No Image" style="object-fit: contain; background: #f1f5f9;">
                                    <?php endif; ?>
                                </td>
                                <td><strong><?= htmlspecialchars($row['nama_produk']); ?></strong></td>
                                <td><?= htmlspecialchars($row['merk'] ?? '-'); ?></td>
                                <td>
                                    <span class="badge-cat"><?= htmlspecialchars($row['nama_kategori'] ?? 'Outdoor'); ?></span>
                                </td>
                                <td class="price-text">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td><span class="badge-stock"><?= $row['stok']; ?></span></td>
                                <td>
                                    <div class="action-links">
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                                        <a href="proses_produk.php?aksi=hapus&id=<?= $row['id']; ?>" 
                                           class="btn-delete" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="empty-row">📦 Belum ada produk outdoor yang tersimpan di database.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>