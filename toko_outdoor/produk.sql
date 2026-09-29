-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 29, 2026 at 04:56 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_outdoor`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `merk` varchar(50) DEFAULT 'Generic',
  `harga` int NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `spesifikasi` text,
  `deskripsi` text,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama_produk`, `merk`, `harga`, `stok`, `spesifikasi`, `deskripsi`, `gambar`, `created_at`) VALUES
(2, 1, 'Tenda Dome 4 Person Waterproof', 'Eiger', 1250000, 10, NULL, 'Tenda berkapasitas 4 orang berbahan polyester waterproof 3000mm. Dilengkapi dengan lapisan double layer, pasak alumunium, dan garansi resmi 1 tahun. Cocok untuk kegiatan camping di cuaca hujan sedang hingga lebat.', '1790697080_588.jpg', '2026-09-29 15:51:20'),
(3, 2, 'Tas Carrier 60L Pro Hiking', 'Consina', 850000, 6, NULL, 'Bahan Cordura nylon super awet dengan kapasitas 60 Liter. Fitur backsystem ergonomis dengan sirkulasi udara baik, termasuk rain cover bawaan dan garansi jahitan 6 bulan.', '1790697281_255.webp', '2026-09-29 15:54:41'),
(4, 5, 'Kompor Windproof Ultra Lightweight', 'REI', 275000, 12, NULL, 'Material stainless steel anti karat dan kuningan tahan panas. Fitur pelindung angin (windproof) bawaan dengan pemantik otomatis, sangat praktis untuk pendakian cepat (ultralight hiking).', '1790697401_445.jpg', '2026-09-29 15:56:41'),
(5, 3, 'Sepatu Gunung Hiking Mid Cut Waterproof', 'Carummby', 2500000, 6, NULL, 'Sepatu hiking tipe mid-cut dengan lapisan membrane waterproof dan outsole rubber anti-slip. Dilengkapi pelindung bagian toe cap, insole empuk Ortholite, dan konstruksi kokoh untuk traksi optimal di medan berbatu maupun berlumpur.', '1790697586_396.jpg', '2026-09-29 15:59:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
