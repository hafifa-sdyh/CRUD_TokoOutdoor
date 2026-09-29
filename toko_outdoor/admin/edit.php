<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/auth.php';
require_once '../config/database.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data produk dari database berdasarkan ID
$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    $_SESSION['error'] = "Produk tidak ditemukan!";
    header("Location: produk.php");
    exit;
}

$produk = mysqli_fetch_assoc($result);

// Ambil daftar kategori untuk pilihan dropdown
$query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin AdventureGear</title>
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
            max-width: 680px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card-form {
            background: #ffffff;
            padding: 30px 35px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }

        .card-form h2 {
            font-size: 1.35rem;
            color: #1e293b;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f1f5f9;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            font-size: 0.925rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            background-color: #f8fafc;
            transition: all 0.2s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            background-color: #ffffff;
            border-color: #1a3322;
            box-shadow: 0 0 0 3px rgba(26, 51, 34, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .img-preview-box {
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .img-preview {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }

        .img-hint {
            font-size: 0.8rem;
            color: #64748b;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .btn-submit {
            flex: 2;
            padding: 12px;
            background-color: #1a3322;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background-color: #2d5a3c;
        }

        .btn-cancel {
            flex: 1;
            display: inline-block;
            text-align: center;
            padding: 12px;
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-cancel:hover {
            background-color: #e2e8f0;
        }
    </style>
</head>
<body>

    <header class="admin-header">
        <h1>🏕️ Admin Panel - AdventureGear</h1>
        <nav class="admin-nav">
            <a href="index.php">Dashboard</a>
            <a href="produk.php">Kelola Produk</a>
            <a href="../index.php" target="_blank">Lihat Website</a>
            <a href="logout.php" style="color: #fca5a5;">Logout</a>
        </nav>
    </header>

    <main class="container">
        <div class="card-form">
            <h2>Edit Peralatan Outdoor</h2>

            <form action="proses_produk.php?aksi=edit" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $produk['id']; ?>">

                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']); ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="kategori_id">Kategori Alat</label>
                        <select id="kategori_id" name="kategori_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php if ($query_kategori): ?>
                                <?php while ($kat = mysqli_fetch_assoc($query_kategori)): ?>
                                    <option value="<?= $kat['id']; ?>" <?= $kat['id'] == $produk['kategori_id'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($kat['nama_kategori']); ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="merk">Merk / Brand</label>
                        <input type="text" id="merk" name="merk" value="<?= htmlspecialchars($produk['merk'] ?? ''); ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="harga">Harga (Rp)</label>
                        <input type="number" id="harga" name="harga" value="<?= $produk['harga']; ?>" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="stok">Jumlah Stok</label>
                        <input type="number" id="stok" name="stok" value="<?= $produk['stok']; ?>" min="0" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi &amp; Spesifikasi Produk</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required><?= htmlspecialchars($produk['deskripsi'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="gambar">Ganti Foto Produk (Opsional)</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*">
                    
                    <?php if (!empty($produk['gambar']) && file_exists('../uploads/produk/' . $produk['gambar'])): ?>
                        <div class="img-preview-box">
                            <img src="../uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>" class="img-preview" alt="Foto Saat Ini">
                            <span class="img-hint">Foto produk saat ini. Biarkan form di atas kosong jika tidak ingin mengganti.</span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-submit">Simpan Perubahan</button>
                    <a href="produk.php" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </main>

</body>
</html>