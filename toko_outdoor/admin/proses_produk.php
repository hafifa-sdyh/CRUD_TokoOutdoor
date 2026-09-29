<?php
// Cek jika sesi belum berjalan sebelum memulai sesi baru
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/auth.php';
require_once '../config/database.php';

$aksi = $_GET['aksi'] ?? '';

// ------------------------------------------------------------------
// PROSES TAMBAH PRODUK
// ------------------------------------------------------------------
if ($aksi === 'tambah') {
    $nama_produk = mysqli_real_escape_string($koneksi, trim($_POST['nama_produk']));
    $kategori_id = intval($_POST['kategori_id']);
    $merk        = mysqli_real_escape_string($koneksi, trim($_POST['merk']));
    $harga       = intval($_POST['harga']);
    $stok        = intval($_POST['stok']);
    $deskripsi   = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi']));

    // Handling Pengunggahan Gambar
    $nama_gambar = $_FILES['gambar']['name'];
    $tmp_gambar  = $_FILES['gambar']['tmp_name'];
    $ext         = strtolower(pathinfo($nama_gambar, PATHINFO_EXTENSION));
    $nama_baru   = time() . '_' . rand(100, 999) . '.' . $ext;
    $target_dir  = '../uploads/produk/' . $nama_baru;

    // Buat folder jika belum ada
    if (!is_dir('../uploads/produk/')) {
        mkdir('../uploads/produk/', 0777, true);
    }

    if (move_uploaded_file($tmp_gambar, $target_dir)) {
        $query = "INSERT INTO produk (kategori_id, nama_produk, merk, harga, stok, deskripsi, gambar) 
                  VALUES ('$kategori_id', '$nama_produk', '$merk', '$harga', '$stok', '$deskripsi', '$nama_baru')";
        
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['success'] = "Produk berhasil ditambahkan!";
        } else {
            $_SESSION['error'] = "Gagal menyimpan ke database: " . mysqli_error($koneksi);
        }
    } else {
        $_SESSION['error'] = "Gagal mengunggah foto produk!";
    }

    header("Location: produk.php");
    exit;
}

// ------------------------------------------------------------------
// PROSES EDIT PRODUK
// ------------------------------------------------------------------
if ($aksi === 'edit') {
    $id          = intval($_POST['id']);
    $nama_produk = mysqli_real_escape_string($koneksi, trim($_POST['nama_produk']));
    $kategori_id = intval($_POST['kategori_id']);
    $merk        = mysqli_real_escape_string($koneksi, trim($_POST['merk']));
    $harga       = intval($_POST['harga']);
    $stok        = intval($_POST['stok']);
    $deskripsi   = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi']));

    if (!empty($_FILES['gambar']['name'])) {
        $nama_gambar = $_FILES['gambar']['name'];
        $tmp_gambar  = $_FILES['gambar']['tmp_name'];
        $ext         = strtolower(pathinfo($nama_gambar, PATHINFO_EXTENSION));
        $nama_baru   = time() . '_' . rand(100, 999) . '.' . $ext;
        $target_dir  = '../uploads/produk/' . $nama_baru;

        if (move_uploaded_file($tmp_gambar, $target_dir)) {
            $query = "UPDATE produk SET 
                      kategori_id='$kategori_id', 
                      nama_produk='$nama_produk', 
                      merk='$merk', 
                      harga='$harga', 
                      stok='$stok', 
                      deskripsi='$deskripsi', 
                      gambar='$nama_baru' 
                      WHERE id='$id'";
        }
    } else {
        $query = "UPDATE produk SET 
                  kategori_id='$kategori_id', 
                  nama_produk='$nama_produk', 
                  merk='$merk', 
                  harga='$harga', 
                  stok='$stok', 
                  deskripsi='$deskripsi' 
                  WHERE id='$id'";
    }

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success'] = "Produk berhasil diperbarui!";
    } else {
        $_SESSION['error'] = "Gagal memperbarui produk: " . mysqli_error($koneksi);
    }

    header("Location: produk.php");
    exit;
}

// ------------------------------------------------------------------
// PROSES HAPUS PRODUK
// ------------------------------------------------------------------
if ($aksi === 'hapus') {
    $id = intval($_GET['id']);
    $query = "DELETE FROM produk WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success'] = "Produk berhasil dihapus!";
    } else {
        $_SESSION['error'] = "Gagal menghapus produk!";
    }

    header("Location: produk.php");
    exit;
}

header("Location: produk.php");
exit;