<?php
require_once 'config/database.php';
include 'includes/header.php';

// Ambil 8 produk terbaru
$query_produk = "SELECT p.*, k.nama_kategori 
                 FROM produk p 
                 LEFT JOIN kategori k ON p.kategori_id = k.id 
                 ORDER BY p.id DESC LIMIT 8";
$result_produk = mysqli_query($koneksi, $query_produk);

// Ambil daftar kategori
$query_kategori = "SELECT * FROM kategori ORDER BY id ASC LIMIT 6";
$result_kategori = mysqli_query($koneksi, $query_kategori);
?>

<style>
    .home-wrapper {
        max-width: 1140px;
        margin: 0 auto;
        padding-bottom: 60px;
    }

    /* 1. HERO BANNER */
    .hero-banner {
        background: linear-gradient(135deg, #1a3322 0%, #2d5a3c 100%);
        color: #ffffff;
        padding: 60px 35px;
        border-radius: 18px;
        margin: 25px 0 40px 0;
        text-align: center;
        box-shadow: 0 10px 30px rgba(26, 51, 34, 0.15);
        position: relative;
        overflow: hidden;
    }

    .hero-banner .hero-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.15);
        color: #d1e2d4;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 16px;
        letter-spacing: 0.5px;
    }

    .hero-banner h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 14px;
        line-height: 1.25;
        letter-spacing: -0.5px;
    }

    .hero-banner p {
        font-size: 1.1rem;
        color: #d1e2d4;
        margin-bottom: 28px;
        max-width: 640px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .hero-actions {
        display: flex;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .btn-secondary-light {
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff;
        padding: 10px 22px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.25s ease;
        border: 1px solid rgba(255, 255, 255, 0.25);
    }

    .btn-secondary-light:hover {
        background: rgba(255, 255, 255, 0.25);
        color: #ffffff;
    }

    /* 2. FITUR UNGGULAN */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
        margin-bottom: 50px;
    }

    .feature-card {
        background: #ffffff;
        padding: 22px 20px;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        transition: all 0.25s ease;
    }

    .feature-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        border-color: #cbd5e1;
    }

    .feature-icon {
        font-size: 2rem;
        background: #f1f5f9;
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .feature-info h4 {
        font-size: 0.95rem;
        color: #0f172a;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .feature-info p {
        font-size: 0.825rem;
        color: #64748b;
    }

    /* 3. SECTION HEADERS */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 24px;
    }

    .section-header h2 {
        font-size: 1.5rem;
        color: #1a3322;
        font-weight: 700;
        letter-spacing: -0.3px;
    }

    .section-header .link-all {
        color: #d9531e;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.925rem;
        transition: color 0.2s ease;
    }

    .section-header .link-all:hover {
        color: #b84114;
        text-decoration: underline;
    }

    /* 4. KATEGORI POPULER */
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 16px;
        margin-bottom: 50px;
    }

    .category-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px 16px;
        text-align: center;
        text-decoration: none;
        color: #0f172a;
        font-weight: 600;
        font-size: 0.925rem;
        transition: all 0.25s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    }

    .category-card:hover {
        background: #1a3322;
        color: #ffffff;
        border-color: #1a3322;
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(26, 51, 34, 0.15);
    }

    .category-card .cat-icon {
        font-size: 1.8rem;
        margin-bottom: 8px;
        display: block;
    }

    /* 5. GRID PRODUK TERBARU */
    .grid-produk {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 22px;
        margin-bottom: 50px;
    }

    .card-produk {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        transition: all 0.25s ease;
    }

    .card-produk:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }

    .card-img-wrapper {
        position: relative;
        width: 100%;
        height: 190px;
        overflow: hidden;
        background-color: #f1f5f9;
    }

    .card-produk img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .card-produk:hover img {
        transform: scale(1.04);
    }

    .card-body {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .category-tag {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #d9531e;
        margin-bottom: 6px;
        letter-spacing: 0.5px;
    }

    .card-body h3 {
        font-size: 1.05rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .card-body .harga {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1a3322;
        margin-top: auto;
        margin-bottom: 14px;
    }

    .btn-detail {
        width: 100%;
        text-align: center;
        padding: 10px;
        background: #f8fafc;
        color: #1a3322;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-detail:hover {
        background: #1a3322;
        color: #ffffff;
        border-color: #1a3322;
    }

    .empty-box {
        background: #ffffff;
        border: 2px dashed #cbd5e1;
        border-radius: 14px;
        padding: 50px 20px;
        text-align: center;
        color: #64748b;
        grid-column: 1 / -1;
    }

    /* 6. BANNER PROMO / CONSULTATION */
    .cta-banner {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 35px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    .cta-content h3 {
        font-size: 1.3rem;
        color: #1a3322;
        margin-bottom: 6px;
    }

    .cta-content p {
        color: #64748b;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .hero-banner {
            padding: 40px 20px;
        }

        .hero-banner h1 {
            font-size: 1.8rem;
        }

        .cta-banner {
            flex-direction: column;
            text-align: center;
        }

        .grid-produk {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 14px;
        }

        .card-img-wrapper {
            height: 140px;
        }
    }
</style>

<div class="home-wrapper">

    <!-- 1. HERO BANNER -->
    <section class="hero-banner">
        <span class="hero-badge">🏕️ ADVENTUREGEAR STORE</span>
        <h1>Perlengkapan Outdoor &amp; Camping Terlengkap</h1>
        <p>Siapkan pendakian dan petualangan alam bebasmu dengan peralatan luar ruangan yang tangguh, aman, dan terpercaya.</p>
        <div class="hero-actions">
            <a href="produk.php" class="btn-primary">Jelajahi Katalog Alat</a>
            <a href="tentang.php" class="btn-secondary-light">Tentang Kami</a>
        </div>
    </section>

    <!-- 2. FITUR UNGGULAN -->
    <section class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">🛡️</div>
            <div class="feature-info">
                <h4>100% Original</h4>
                <p>Garansi produk merk resmi</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🚚</div>
            <div class="feature-info">
                <h4>Kirim Cepat</h4>
                <p>Ke seluruh pelosok ID</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">⛺</div>
            <div class="feature-info">
                <h4>Alat Lengkap</h4>
                <p>Tenda, carrier, &amp; sepatu</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">💬</div>
            <div class="feature-info">
                <h4>Konsultasi Bebas</h4>
                <p>Tim siap pandu sarana alat</p>
            </div>
        </div>
    </section>

    <!-- 3. KATEGORI POPULER -->
    <?php if ($result_kategori && mysqli_num_rows($result_kategori) > 0): ?>
    <section style="margin-bottom: 40px;">
        <div class="section-header">
            <h2>Kategori Peralatan</h2>
            <a href="produk.php" class="link-all">Lihat Semua Kategori &rarr;</a>
        </div>
        <div class="category-grid">
            <?php 
            $icons = ['🏕️️', '🎒', '🥾', '🧥', '🍳', '⛺'];
            $i = 0;
            while ($kat = mysqli_fetch_assoc($result_kategori)): 
                $icon = $icons[$i % count($icons)];
                $i++;
            ?>
                <a href="produk.php?kategori=<?= $kat['id']; ?>" class="category-card">
                    <span class="cat-icon"><?= $icon; ?></span>
                    <?= htmlspecialchars($kat['nama_kategori']); ?>
                </a>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 4. PRODUK TERBARU -->
    <section style="margin-bottom: 50px;">
        <div class="section-header">
            <h2>Perlengkapan Terbaru</h2>
            <a href="produk.php" class="link-all">Lihat Semua Katalog &rarr;</a>
        </div>

        <div class="grid-produk">
            <?php if ($result_produk && mysqli_num_rows($result_produk) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result_produk)): ?>
                    <div class="card-produk">
                        <div class="card-img-wrapper">
                            <?php if (!empty($row['gambar']) && file_exists('uploads/produk/' . $row['gambar'])): ?>
                                <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama_produk']); ?>">
                            <?php else: ?>
                                <img src="assets/no-image.png" alt="No Image" style="object-fit: contain; padding: 20px;">
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <span class="category-tag"><?= htmlspecialchars($row['nama_kategori'] ?? 'Outdoor Gear'); ?></span>
                            <h3><?= htmlspecialchars($row['nama_produk']); ?></h3>
                            <p class="harga">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                            <a href="detail.php?id=<?= $row['id']; ?>" class="btn-detail">Lihat Detail Alat</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-box">
                    <p>📦 Belum ada peralatan outdoor yang ditambahkan ke database.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- 5. BANNER CONSULTATION / CTA -->
    <section class="cta-banner">
        <div class="cta-content">
            <h3>Bingung Memilih Perlengkapan Pendakian?</h3>
            <p>Konsultasikan kebutuhan peralatan camping dan mendakimu langsung dengan tim kami.</p>
        </div>
        <a href="https://wa.me/6281234567890?text=Halo%20AdventureGear,%20saya%20ingin%20konsultasi%20perlengkapan%20outdoor" target="_blank" class="btn-primary">💬 Tanya via WhatsApp</a>
    </section>

</div>

<?php include 'includes/footer.php'; ?>