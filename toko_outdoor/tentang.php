<?php
require_once 'config/database.php';
include 'includes/header.php';
?>

<style>
    .about-wrapper {
        max-width: 1140px;
        margin: 0 auto;
        padding: 25px 20px 60px 20px;
    }

    /* Hero Header Banner */
    .about-hero {
        background: linear-gradient(135deg, #1a3322 0%, #2d5a3c 100%);
        color: #ffffff;
        padding: 45px 30px;
        border-radius: 16px;
        text-align: center;
        margin-bottom: 35px;
        box-shadow: 0 10px 25px rgba(26, 51, 34, 0.12);
    }

    .about-hero .badge-hero {
        display: inline-block;
        background: rgba(255, 255, 255, 0.15);
        color: #d1e2d4;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 12px;
        letter-spacing: 0.5px;
    }

    .about-hero h1 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }

    .about-hero p {
        color: #d1e2d4;
        font-size: 1.05rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Kisah Kami Section (Grid 2 Kolom Tanpa Box Putus-putus) */
    .story-section {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 25px;
        align-items: stretch;
        margin-bottom: 45px;
    }

    .story-card {
        background: #ffffff;
        padding: 35px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .story-card h2 {
        font-size: 1.6rem;
        color: #1a3322;
        margin-bottom: 16px;
        position: relative;
        padding-bottom: 10px;
    }

    .story-card h2::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 40px;
        height: 3px;
        background-color: #d9531e;
        border-radius: 2px;
    }

    .story-card p {
        color: #334155;
        line-height: 1.8;
        font-size: 0.975rem;
        margin-bottom: 14px;
    }

    .story-card p:last-child {
        margin-bottom: 0;
    }

    /* Stat Highlight Cards (Pengganti Box Garis Putus-putus) */
    .stats-grid-about {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .stat-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 24px 18px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .stat-box:hover {
        transform: translateY(-4px);
        border-color: #1a3322;
        box-shadow: 0 8px 20px rgba(26, 51, 34, 0.08);
    }

    .stat-box .icon {
        font-size: 2.2rem;
        margin-bottom: 8px;
    }

    .stat-box .num {
        font-size: 1.4rem;
        font-weight: 800;
        color: #1a3322;
        margin-bottom: 4px;
    }

    .stat-box .label {
        font-size: 0.825rem;
        color: #64748b;
        font-weight: 600;
    }

    /* Visi & Misi Section */
    .section-header-center {
        text-align: center;
        margin-bottom: 30px;
    }

    .section-header-center h2 {
        font-size: 1.6rem;
        color: #1a3322;
    }

    .section-header-center p {
        color: #64748b;
        font-size: 0.95rem;
        margin-top: 4px;
    }

    .vm-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 45px;
    }

    .vm-card {
        background: #ffffff;
        padding: 30px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .vm-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: #1a3322;
    }

    .vm-card.misi::before {
        background: #d9531e;
    }

    .vm-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    }

    .vm-card .icon-head {
        font-size: 2.2rem;
        margin-bottom: 12px;
    }

    .vm-card h3 {
        font-size: 1.25rem;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .vm-card p, .vm-card li {
        color: #475569;
        font-size: 0.95rem;
        line-height: 1.7;
    }

    .vm-card ul {
        padding-left: 18px;
    }

    .vm-card li {
        margin-bottom: 8px;
    }

    /* Fitur Keunggulan */
    .features-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 45px;
    }

    .feature-item {
        background: #ffffff;
        padding: 25px 20px;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        text-align: center;
        transition: all 0.25s ease;
    }

    .feature-item:hover {
        transform: translateY(-4px);
        border-color: #1a3322;
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    }

    .feature-item .f-icon {
        font-size: 2.2rem;
        margin-bottom: 10px;
    }

    .feature-item h4 {
        font-size: 1.05rem;
        color: #1e293b;
        margin-bottom: 6px;
        font-weight: 700;
    }

    .feature-item p {
        font-size: 0.875rem;
        color: #64748b;
    }

    /* Basecamp Banner CTA */
    .basecamp-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 35px 25px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .basecamp-card h3 {
        font-size: 1.35rem;
        color: #1a3322;
        margin-bottom: 15px;
    }

    .basecamp-info {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-bottom: 25px;
        color: #475569;
        font-size: 0.925rem;
    }

    .basecamp-info span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f8fafc;
        padding: 8px 16px;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
    }

    @media (max-width: 850px) {
        .story-section, .vm-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="about-wrapper">

    <!-- Hero Banner Header -->
    <section class="about-hero">
        <span class="badge-hero">🏕️ TOKO PERALATAN OUTDOOR</span>
        <h1>Tentang AdventureGear</h1>
        <p>Mitra Terpercaya untuk Setiap Petualangan Luar Ruangan Anda di Seluruh Indonesia</p>
    </section>

    <!-- Kisah Kami + Stat Grid -->
    <section class="story-section">
        <div class="story-card">
            <h2>Kisah Kami</h2>
            <p>
                <strong>AdventureGear</strong> didirikan untuk memenuhi kebutuhan para pecinta alam, pendaki gunung, camper, dan petualang outdoor. Kami percaya bahwa petualangan yang hebat dimulai dengan perlengkapan yang tangguh, aman, dan nyaman.
            </p>
            <p>
                Kami menyediakan berbagai peralatan kegiatan luar ruangan berkualitas tinggi—mulai dari tenda camping, tas carrier, sepatu gunung, jaket waterproof, hingga peralatan masak lapangan dari merk-merk terpercaya.
            </p>
        </div>

        <div class="stats-grid-about">
            <div class="stat-box">
                <div class="icon">💯</div>
                <div class="num">100%</div>
                <div class="label">Produk Original</div>
            </div>
            <div class="stat-box">
                <div class="icon">🎒</div>
                <div class="num">500+</div>
                <div class="label">Peralatan Siap</div>
            </div>
            <div class="stat-box">
                <div class="icon">⭐</div>
                <div class="num">4.9 / 5</div>
                <div class="label">Rating Petualang</div>
            </div>
            <div class="stat-box">
                <div class="icon">🚚</div>
                <div class="num">Cepat</div>
                <div class="label">Kirim Seluruh ID</div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section style="margin-bottom: 45px;">
        <div class="section-header-center">
            <h2>Visi &amp; Misi</h2>
            <p>Komitmen kami dalam mendukung kegiatan luar ruangan secara aman dan bertanggung jawab</p>
        </div>

        <div class="vm-grid">
            <div class="vm-card">
                <div class="icon-head">🚀</div>
                <h3>Visi Kami</h3>
                <p>Menjadi toko perlengkapan outdoor terdepan dan terpercaya di Indonesia yang menginspirasi masyarakat untuk menjelajahi dan mencintai alam bebas secara aman dan bertanggung jawab.</p>
            </div>
            <div class="vm-card misi">
                <div class="icon-head">🎯</div>
                <h3>Misi Kami</h3>
                <ul>
                    <li>Menyediakan produk outdoor berkualitas tinggi dengan harga kompetitif.</li>
                    <li>Memberikan pelayanan terbaik dan konsultasi perlengkapan bagi calon pendaki/camper.</li>
                    <li>Mendukung gerakan konservasi alam dan edukasi keselamatan kegiatan alam terbuka.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Keunggulan Layanan -->
    <section style="margin-bottom: 45px;">
        <div class="section-header-center">
            <h2>Mengapa Memilih AdventureGear?</h2>
        </div>
        <div class="features-row">
            <div class="feature-item">
                <div class="f-icon">🛡️</div>
                <h4>100% Original</h4>
                <p>Jaminan kualitas dari merk outdoor resmi.</p>
            </div>
            <div class="feature-item">
                <div class="f-icon">⛺</div>
                <h4>Lengkap &amp; Tangguh</h4>
                <p>Kebutuhan pendakian hingga camping keluarga.</p>
            </div>
            <div class="feature-item">
                <div class="f-icon">🤝</div>
                <h4>Konsultasi Alat</h4>
                <p>Bantu pilihkan alat sesuai medan pendakian.</p>
            </div>
            <div class="feature-item">
                <div class="f-icon">🚚</div>
                <h4>Pengiriman Aman</h4>
                <p>Siap kirim cepat ke seluruh wilayah Indonesia.</p>
            </div>
        </div>
    </section>

    <!-- Info Basecamp / Kontak -->
    <section class="basecamp-card">
        <h3>Basecamp &amp; Toko Fisik Kami</h3>
        <div class="basecamp-info">
            <span>📍 Jl. Raya Petualang No. 123, Indonesia</span>
            <span>🕒 Senin - Minggu (08.00 - 21.00 WIB)</span>
            <span>📞 +62 812-3456-7890</span>
        </div>
        <a href="produk.php" class="btn-primary">Lihat Katalog Peralatan</a>
    </section>

</div>

<?php include 'includes/footer.php'; ?>