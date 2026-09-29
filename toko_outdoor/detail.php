<?php
require_once 'config/database.php';
include 'includes/header.php';

// Ambil ID produk dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query mengambil data detail produk beserta kategorinya
$query = "SELECT p.*, k.nama_kategori 
          FROM produk p 
          LEFT JOIN kategori k ON p.kategori_id = k.id 
          WHERE p.id = $id";
$result = mysqli_query($koneksi, $query);
$produk = ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
?>

<style>
    .detail-container {
        max-width: 1000px;
        margin: 30px auto 60px auto;
        padding: 0 20px;
    }

    .breadcrumb {
        margin-bottom: 20px;
        font-size: 0.9rem;
        color: #64748b;
    }

    .breadcrumb a {
        color: #1a3322;
        text-decoration: none;
        font-weight: 600;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .detail-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        padding: 35px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: start;
    }

    .detail-image {
        width: 100%;
        height: 380px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .no-img-box {
        width: 100%;
        height: 380px;
        background-color: #f1f5f9;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        font-size: 1.1rem;
    }

    .detail-info .category-badge {
        display: inline-block;
        background-color: #e2e8f0;
        color: #1a3322;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 12px;
    }

    .detail-info h1 {
        font-size: 1.8rem;
        color: #1e293b;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .detail-info .merk-tag {
        font-size: 0.95rem;
        color: #64748b;
        margin-bottom: 15px;
    }

    .detail-info .price-tag {
        font-size: 1.8rem;
        font-weight: 800;
        color: #1a3322;
        margin-bottom: 20px;
    }

    .spec-box {
        background-color: #f8fafc;
        border-left: 4px solid #1a3322;
        padding: 15px 20px;
        border-radius: 0 8px 8px 0;
        margin-bottom: 25px;
    }

    .spec-box h3 {
        font-size: 1rem;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .spec-box p {
        color: #475569;
        font-size: 0.925rem;
        line-height: 1.6;
        white-space: pre-line;
    }

    .stock-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem;
        margin-bottom: 25px;
        color: #334155;
    }

    .stock-badge {
        background-color: #dcfce7;
        color: #166534;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .btn-buy {
        display: inline-block;
        width: 100%;
        text-align: center;
        background-color: #d9531e;
        color: #ffffff;
        padding: 14px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1rem;
        transition: background-color 0.2s ease;
    }

    .btn-buy:hover {
        background-color: #b84114;
    }

    .empty-card {
        background: #ffffff;
        padding: 50px;
        text-align: center;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        color: #64748b;
    }

    @media (max-width: 768px) {
        .detail-card {
            grid-template-columns: 1fr;
        }
        .detail-image, .no-img-box {
            height: 260px;
        }
    }
</style>

<div class="detail-container">
    
    <div class="breadcrumb">
        <a href="index.php">Beranda</a> &rsaquo; 
        <a href="produk.php">Katalog Peralatan</a> &rsaquo; 
        <span>Detail Peralatan</span>
    </div>

    <?php if ($produk): ?>
        <div class="detail-card">
            <!-- Gambar Produk -->
            <div>
                <?php if (!empty($produk['gambar']) && file_exists('uploads/produk/' . $produk['gambar'])): ?>
                    <img src="uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>" alt="<?= htmlspecialchars($produk['nama_produk']); ?>" class="detail-image">
                <?php else: ?>
                    <div class="no-img-box">
                        📷 Foto Produk Tidak Tersedia
                    </div>
                <?php endif; ?>
            </div>

            <!-- Informasi Produk -->
            <div class="detail-info">
                <span class="category-badge"><?= htmlspecialchars($produk['nama_kategori'] ?? 'Outdoor'); ?></span>
                <h1><?= htmlspecialchars($produk['nama_produk']); ?></h1>
                <p class="merk-tag">Merk / Brand: <strong><?= htmlspecialchars($produk['merk'] ?? 'Generic'); ?></strong></p>
                <div class="price-tag">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></div>

                <div class="stock-info">
                    <span>Ketersediaan Stok:</span>
                    <span class="stock-badge"><?= $produk['stok']; ?> Unit Tersedia</span>
                </div>

                <div class="spec-box">
                    <h3>Deskripsi &amp; Spesifikasi:</h3>
                    <p><?= htmlspecialchars($produk['deskripsi'] ?? 'Belum ada deskripsi untuk produk ini.'); ?></p>
                </div>

                <a href="https://wa.me/6281234567890?text=Halo%20AdventureGear,%20saya%20tertarik%20dengan%20produk%20<?= urlencode($produk['nama_produk']); ?>" target="_blank" class="btn-buy">💬 Hubungi via WhatsApp untuk Pemesanan</a>
            </div>
        </div>
    <?php else: ?>
        <div class="empty-card">
            <h2>📦 Produk Tidak Ditemukan</h2>
            <p style="margin-top: 10px;">Peralatan outdoor yang Anda cari tidak tersedia atau telah dihapus.</p>
            <a href="produk.php" class="btn-primary" style="margin-top: 20px; display: inline-block;">Kembali ke Katalog</a>
        </div>
    <?php endif; ?>

</div>

<?php include 'includes/footer.php'; ?>