-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: dbserver
-- Waktu pembuatan: 31 Des 2025 pada 17.40
-- Versi server: 11.8.5-MariaDB-ubu2404
-- Versi PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `appdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrean`
--

CREATE TABLE `antrean` (
  `id` int(11) NOT NULL,
  `faskes_id` int(11) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `tanggal_antrean` date NOT NULL,
  `nomor_antrean` int(11) NOT NULL,
  `status` enum('Menunggu','Dipanggil','Selesai','Batal') DEFAULT 'Menunggu',
  `waktu_buat` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `antrean`
--

INSERT INTO `antrean` (`id`, `faskes_id`, `nama_pasien`, `nik`, `tanggal_antrean`, `nomor_antrean`, `status`, `waktu_buat`) VALUES
(2, 1, 'Rangga', '3303040203060002', '2025-12-17', 2, 'Menunggu', '2025-12-17 05:50:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `faskes`
--

CREATE TABLE `faskes` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `kuota_harian` int(11) DEFAULT 50,
  `antrean_saat_ini` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `faskes`
--

INSERT INTO `faskes` (`id`, `nama`, `alamat`, `jam_buka`, `jam_tutup`, `kategori`, `kuota_harian`, `antrean_saat_ini`) VALUES
(1, 'RSUD Jakarta Pusat', 'Jl. Medan Merdeka No.10, Jakarta Pusat', '08:00:00', '20:00:00', 'Rumah Sakit', 100, 27),
(2, 'Puskesmas Tanah Abang', 'Jl. KS Tubun No.5, Jakarta Pusat', '07:00:00', '14:00:00', 'Puskesmas', 50, 15),
(3, 'Klinik Sehat Sentosa', 'Jl. Kebon Kacang No.12, Jakarta Pusat', '09:00:00', '17:00:00', 'Klinik', 30, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_transportasi`
--

CREATE TABLE `jenis_transportasi` (
  `id` int(11) NOT NULL,
  `nama_transportasi` varchar(50) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `jenis_transportasi`
--

INSERT INTO `jenis_transportasi` (`id`, `nama_transportasi`, `icon`, `status`, `created_at`) VALUES
(1, 'TransJakarta', 'fa-bus', 'aktif', '2025-12-31 13:42:04'),
(2, 'MRT Jakarta', 'fa-train', 'aktif', '2025-12-31 13:42:04'),
(3, 'LRT Jakarta', 'fa-train-subway', 'aktif', '2025-12-31 13:42:04'),
(4, 'KRL Commuter Line', 'fa-subway', 'aktif', '2025-12-31 13:42:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `lokasi` text NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('pending','diproses','selesai','ditolak') DEFAULT 'pending',
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_user`, `kategori`, `lokasi`, `deskripsi`, `foto`, `status`, `tanggal`) VALUES
(4, 4, 'Lain-lain', 'Jalan Islamica no. 12', 'Terjadi genangan air besar membuat kemacetan', '1765786565_693fc3c5cec80.jpg', 'pending', '2025-12-15 08:16:05'),
(5, 4, 'Lampu Jalan Mati', 'Jalan Pandanaran no. 12', 'Lampu sedikit miring dan mati, kemudian juga condong menghalangi jalan', '1765801376_693ffda0f3644.jpg', 'pending', '2025-12-15 12:22:57'),
(8, 4, 'Sampah/Kebersihan Lingkungan', 'Jalan kaliurang Km 14', 'Sampah menumpuk', '1766127659_6944f82b8d65a.jpg', 'pending', '2025-12-19 07:00:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rute`
--

CREATE TABLE `rute` (
  `id` int(11) NOT NULL,
  `jenis_transportasi_id` int(11) NOT NULL,
  `nama_rute` varchar(100) NOT NULL,
  `stasiun_awal` varchar(100) NOT NULL,
  `stasiun_akhir` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `durasi_menit` int(11) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `rute`
--

INSERT INTO `rute` (`id`, `jenis_transportasi_id`, `nama_rute`, `stasiun_awal`, `stasiun_akhir`, `harga`, `durasi_menit`, `status`, `created_at`) VALUES
(1, 1, 'Koridor 1', 'Blok M', 'Kota', 3500.00, 45, 'aktif', '2025-12-31 13:42:04'),
(2, 1, 'Koridor 2', 'Pulo Gadung', 'Harmoni', 3500.00, 40, 'aktif', '2025-12-31 13:42:04'),
(3, 2, 'Lebak Bulus - Bundaran HI', 'Lebak Bulus', 'Bundaran HI', 5000.00, 30, 'aktif', '2025-12-31 13:42:04'),
(4, 3, 'Velodrome - Pegangsaan Dua', 'Velodrome', 'Pegangsaan Dua', 5000.00, 25, 'aktif', '2025-12-31 13:42:04'),
(5, 4, 'Bogor - Jakarta Kota', 'Bogor', 'Jakarta Kota', 8000.00, 90, 'aktif', '2025-12-31 13:42:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `email`, `created_at`) VALUES
(4, 'admin', '$2y$10$7AlEDMeamY.oK0ynhWPdhOiBxwr736zmkxt1GJwV2ZGrlCM8bqywi', 'Administrator', '', '2025-12-07 18:39:34'),
(6, 'Bayu@123', '$2y$10$PL4LdbaDoLTEHDodyg8vl.o3AFu7x1NCZNbISi0WsM5ObD2MGhuqe', 'Bayu', 'Bayu@123', '2025-12-29 13:32:50');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `antrean`
--
ALTER TABLE `antrean`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_faskes` (`faskes_id`);

--
-- Indeks untuk tabel `faskes`
--
ALTER TABLE `faskes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_transportasi`
--
ALTER TABLE `jenis_transportasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `fk_laporan_user` (`id_user`);

--
-- Indeks untuk tabel `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_transportasi_id` (`jenis_transportasi_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrean`
--
ALTER TABLE `antrean`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `faskes`
--
ALTER TABLE `faskes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenis_transportasi`
--
ALTER TABLE `jenis_transportasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rute`
--
ALTER TABLE `rute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `antrean`
--
ALTER TABLE `antrean`
  ADD CONSTRAINT `fk_faskes` FOREIGN KEY (`faskes_id`) REFERENCES `faskes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `fk_laporan_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `rute_ibfk_1` FOREIGN KEY (`jenis_transportasi_id`) REFERENCES `jenis_transportasi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
