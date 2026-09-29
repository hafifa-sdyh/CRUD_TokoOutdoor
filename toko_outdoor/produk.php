<?php
require_once 'config/database.php';
include 'includes/header.php';

$selected_kategori = isset($_GET['kategori']) ? intval($_GET['kategori']) : 0;

$where = "";
if ($selected_kategori > 0) {
    $where = "WHERE p.kategori_id = $selected_kategori";
}

$query = "SELECT p.*, k.nama_kategori 
          FROM produk p 
          LEFT JOIN kategori k ON p.kategori_id = k.id 
          $where 
          ORDER BY p.id DESC";
$result = mysqli_query($koneksi, $query);

$query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
?>

<section class="katalog-section">
    <h2>Katalog Peralatan Outdoor</h2>
    
    <!-- Filter Kategori Badges -->
    <div class="filter-kategori">
        <a href="produk.php" class="badge <?= $selected_kategori === 0 ? 'active' : ''; ?>">Semua</a>
        <?php if ($query_kategori): ?>
            <?php while ($kat = mysqli_fetch_assoc($query_kategori)): ?>
                <a href="produk.php?kategori=<?= $kat['id']; ?>" 
                   class="badge <?= $selected_kategori == $kat['id'] ? 'active' : ''; ?>">
                    <?= htmlspecialchars($kat['nama_kategori']); ?>
                </a>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <!-- Grid Produk -->
    <div class="grid-produk">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="card-produk">
                    <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama_produk']); ?>">
                    <div class="card-body">
                        <span class="category-tag"><?= htmlspecialchars($row['nama_kategori'] ?? 'Outdoor'); ?></span>
                        <h3><?= htmlspecialchars($row['nama_produk']); ?></h3>
                        <p class="harga">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                        <a href="detail.php?id=<?= $row['id']; ?>" class="btn-primary" style="width: 100%; text-align: center;">Lihat Detail</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <p>📦 Belum ada produk untuk kategori ini.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>