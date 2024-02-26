-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Feb 2024 pada 04.43
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keuangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `posisi` varchar(40) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `umur` int(11) NOT NULL,
  `kontak` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `posisi`, `alamat`, `umur`, `kontak`) VALUES
(7, 'Reno Renaldi, S.Kom', 'Bandahara', 'Kalimantan Selatan', 20, '083144021234'),
(8, 'Rendy', 'Bendahara', 'Batubara', 19, '081770099112'),
(9, 'Wulan', 'Bendahara', 'Sambas', 21, '089922445512'),
(10, 'irwan', 'karyawan', 'cempaka', 22, '0829115134613'),
(11, 'fauzan', 'kabid', 'landasan ulin', 23, '08190681273581'),
(12, 'Riduan Riswanda', 'Bandahara', 'Banjarmasin', 22, '083144021234'),
(13, 'Budi', 'Kepala Dinas', 'Banjarmasin', 33, '081234567890'),
(14, 'Andre', 'Kepala Dinas', 'Banjarmasin', 33, '081234567890'),
(15, 'Andre', 'Kepala Dinas', 'Banjarmasin', 33, '081234567890'),
(16, 'Andre', 'Kepala Dinas', 'Banjarmasin', 33, '081234567890'),
(17, 'Andre', 'Kepala Dinas', 'Banjarmasin', 33, '081234567890'),
(18, 'Andre', 'Kepala Dinas', 'Banjarmasin', 33, '081234567890'),
(19, 'Mazidatul Asma', 'Kabag', 'Amuntai', 21, '081254162069'),
(20, 'Hapip', 'Kepala Dinas', 'Bandung', 29, '08715698137'),
(21, 'Hana Syarefa', 'Kabag', 'Amuntai', 22, '082150151567'),
(22, 'Hana Syarefa', 'Kabag', 'Amuntai', 22, '082150151567');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `total` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `tgl_kegiatan`, `kegiatan`, `total`) VALUES
(1, '2024-02-06', 'erwrew', 100),
(4, '2024-02-06', 'Tidur', 2000),
(6, '2024-02-01', 'Dinas Keluar Kota', 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `tgl_pemasukan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `tgl_pemasukan`, `jumlah`, `sumber`) VALUES
(57, '2024-02-06', 100000, 'Anggaran Pusat'),
(58, '2024-02-06', 2000, 'Anggaran Provinsi'),
(59, '2024-02-01', 500000, 'Anggaran Pusat'),
(60, '2024-02-04', 8000000, 'Anggaran Provinsi'),
(61, '2024-02-07', 5000000, 'Anggaran Provinsi'),
(62, '2024-02-09', 1000000, 'Anggaran Pusat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_sumber` int(11) NOT NULL,
  `sumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tgl_pengeluaran`, `jumlah`, `id_sumber`, `sumber`) VALUES
(1, '2024-02-01', 1000000, 2, 'server'),
(2, '2024-02-05', 50000, 0, 'Monitor'),
(34, '2024-02-06', 100000, 0, 'Motor Dinas'),
(35, '0000-00-00', 100000, 0, 'Kipas angin'),
(36, '2024-02-03', 100000, 0, 'kursi'),
(37, '2024-02-09', 5000000, 0, 'Laptop'),
(38, '2024-02-07', 1500000, 0, 'Service AC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `requester` int(5) NOT NULL,
  `title` varchar(512) NOT NULL,
  `qty` int(5) NOT NULL,
  `price` int(10) NOT NULL,
  `status` varchar(16) NOT NULL,
  `admin_response` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `requests`
--

INSERT INTO `requests` (`id`, `requester`, `title`, `qty`, `price`, `status`, `admin_response`) VALUES
(1, 2, 'Kipas Angin Gantung 20x20cm', 10, 50000, '1', 1706573308),
(2, 2, 'Komputer Gaming', 15, 12000000, '2', 1706578308),
(3, 2, 'Meja Makan', 5, 150000, '1', 1706578306),
(4, 2, 'Meja Kerja', 10, 250000, '2', 1706578303),
(5, 2, 'Kipas Angin Gaming', 10, 15000, '1', 1706578300),
(6, 2, 'Motor Dinas', 5, 20000000, '1', 1706578727),
(7, 2, 'Rak Server', 5, 10000000, '1', 1706778190),
(8, 2, 'laptop', 5, 10000000, '1', 1707095893),
(9, 2, 'PC ROG', 2, 1000000, '1', 1707227862),
(11, 15, 'Kursi Kantor', 5, 1000000, '2', 1708479831);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumber`
--

CREATE TABLE `sumber` (
  `id_sumber` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `sumber`
--

INSERT INTO `sumber` (`id_sumber`, `nama`) VALUES
(11, 'Anggaran Pusat'),
(12, 'Anggaran Provinsi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang`
--

CREATE TABLE `uang` (
  `id_uang` int(11) NOT NULL,
  `tgl_uang` date NOT NULL,
  `id_pengeluaran` int(11) DEFAULT NULL,
  `id_pendapatan` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `uang`
--

INSERT INTO `uang` (`id_uang`, `tgl_uang`, `id_pengeluaran`, `id_pendapatan`, `jumlah`) VALUES
(1, '2019-10-23', NULL, 1, 500000),
(2, '2019-10-24', 2, NULL, 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `pass`, `role`) VALUES
(1, 'Naufal', 'naufal@gmail.com', 'naufal', 'admin'),
(2, 'Reno Renaldi, S.Kom', 'reno@gmail.com', 'reno', 'worker'),
(3, 'Reno REAL', 'renoreal@gmail.com', 'renoreal', 'worker'),
(4, 'Wulan', 'wulan@gmail.com', 'wulan', 'worker'),
(8, 'Andre', 'adam@gmail.com', '123456', 'worker'),
(12, 'Budi', 'budi@gmail.com', '12', 'admin'),
(13, 'udin', 'udin@gmail.com', 'udin', 'admin'),
(14, 'Mazidatul Asma', 'mazidatul@gmail.com', 'mazidatul', 'worker'),
(15, 'Hapip', 'hapip@gmail.com', 'hapip', 'worker'),
(16, 'fauzan', 'fauzan@gmail.com', 'fauzan', 'admin'),
(17, 'Hana Syarefa', 'ahlun.nazar9b@gmail.com', '', 'worker'),
(18, 'Hana Syarefa', '9b@gmail.com', '', 'worker');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_sumber` (`id_sumber`);

--
-- Indeks untuk tabel `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sumber`
--
ALTER TABLE `sumber`
  ADD PRIMARY KEY (`id_sumber`);

--
-- Indeks untuk tabel `uang`
--
ALTER TABLE `uang`
  ADD PRIMARY KEY (`id_uang`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `sumber`
--
ALTER TABLE `sumber`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `uang`
--
ALTER TABLE `uang`
  MODIFY `id_uang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
