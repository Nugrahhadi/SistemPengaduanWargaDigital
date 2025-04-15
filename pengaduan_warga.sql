-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Apr 2025 pada 12.28
-- Versi server: 8.0.30
-- Versi PHP: 8.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_warga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pengaduan`
--

CREATE TABLE `kategori_pengaduan` (
  `id` int NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori_pengaduan`
--

INSERT INTO `kategori_pengaduan` (`id`, `nama_kategori`, `deskripsi`) VALUES
(1, 'Keamanan', 'Masalah terkait keamanan lingkungan'),
(2, 'Kebersihan', 'Masalah terkait kebersihan lingkungan'),
(3, 'Infrastruktur', 'Masalah terkait jalan, saluran air, dll'),
(4, 'Ketertiban', 'Masalah terkait ketertiban warga'),
(5, 'Lainnya', 'Pengaduan lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_status`
--

CREATE TABLE `log_status` (
  `id` int NOT NULL,
  `pengaduan_id` int NOT NULL,
  `status_lama` enum('baru','diproses','selesai') DEFAULT NULL,
  `status_baru` enum('baru','diproses','selesai') NOT NULL,
  `tanggal_perubahan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `log_status`
--

INSERT INTO `log_status` (`id`, `pengaduan_id`, `status_lama`, `status_baru`, `tanggal_perubahan`, `user_id`) VALUES
(1, 1, 'baru', 'diproses', '2025-04-15 06:08:13', 4),
(2, 1, 'diproses', 'diproses', '2025-04-15 08:09:10', 4),
(4, 3, 'baru', 'baru', '2025-04-15 11:01:40', 4),
(5, 3, 'baru', 'diproses', '2025-04-15 11:02:10', 4),
(6, 3, 'diproses', 'selesai', '2025-04-15 12:04:26', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `kategori_id` int NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi_laporan` text NOT NULL,
  `tanggal_pengaduan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('baru','diproses','selesai') NOT NULL DEFAULT 'baru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `user_id`, `kategori_id`, `judul`, `isi_laporan`, `tanggal_pengaduan`, `status`) VALUES
(1, 2, 3, 'Jalan Rusak', 'Jalan di gang saya terdapat 3 lubang yang membuat perjalanan menjadi kurang nyama, sehingga ketika hujan terdapat genangan air yang membahayakan untuk warga sekitar', '2025-04-15 06:04:26', 'diproses'),
(3, 5, 2, 'Sampah Tidak Kunjung Diambil', 'Sampah tidak diambil lebih dari 3 hari oleh petugas kebersihan', '2025-04-15 10:56:49', 'selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id` int NOT NULL,
  `pengaduan_id` int NOT NULL,
  `user_id` int NOT NULL,
  `tanggapan` text NOT NULL,
  `tanggal_tanggapan` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id`, `pengaduan_id`, `user_id`, `tanggapan`, `tanggal_tanggapan`) VALUES
(1, 1, 4, 'Selesai dalam 3 hari', '2025-04-15 08:09:10'),
(2, 1, 2, 'Baik terima kasih pak', '2025-04-15 08:12:17'),
(3, 3, 4, 'Petugas kebersihan akan kembali esok', '2025-04-15 11:01:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text,
  `no_telp` varchar(15) DEFAULT NULL,
  `role` enum('warga','admin') NOT NULL DEFAULT 'warga',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `alamat`, `no_telp`, `role`, `created_at`) VALUES
(1, 'Jeskris', '$2y$12$TE2M5ty1IgPuMeFX8/SQX.ZhjvWf88b7vnhONLGqDdBWIJW7YPdPG', 'Jeskris Oktovianus', 'Blater Raya No.8', '081276895670', 'warga', '2025-04-15 04:52:14'),
(2, 'Arga', '$2y$12$iXT6mQtEUOI/43Ykfqq3U.7zkYih3PkcZmEauTu3gnsLQz49UrcRm', 'Arga Haryanto', 'Purwokerto Raya No.8', '085467838752', 'warga', '2025-04-15 04:53:27'),
(4, 'admin', '$2y$12$Cj0Nl74oi1FuYAmkD0zla.56Ihhol5nykMymCn1Rg6HUIjF3/DPQa', 'Administrator', 'Kantor RT', '081234567890', 'admin', '2025-04-15 05:09:00'),
(5, 'Hadi', '$2y$12$k4bpOny7zWeeZhcmSQo98etABdyGKyK4Tshe4Hkii8X5sVwytTXxu', 'Nugrahhadi Al Khawarizmi', 'Gemilang Raya No.8', '081245678901', 'warga', '2025-04-15 10:54:57');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori_pengaduan`
--
ALTER TABLE `kategori_pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_status`
--
ALTER TABLE `log_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaduan_id` (`pengaduan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaduan_id` (`pengaduan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori_pengaduan`
--
ALTER TABLE `kategori_pengaduan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `log_status`
--
ALTER TABLE `log_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `log_status`
--
ALTER TABLE `log_status`
  ADD CONSTRAINT `log_status_ibfk_1` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_status_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengaduan_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_pengaduan` (`id`);

--
-- Ketidakleluasaan untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
