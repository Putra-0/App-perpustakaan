-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2022 at 10:57 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `jk_anggota` char(1) NOT NULL,
  `jurusan_anggota` varchar(15) NOT NULL,
  `no_telp_anggota` varchar(13) NOT NULL,
  `alamat_anggota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_anggota`, `jk_anggota`, `jurusan_anggota`, `no_telp_anggota`, `alamat_anggota`) VALUES
(1, 'dimas wahyu', 'L', 'informatika', '0891161662161', 'yogyakarta pogung timur'),
(2, 'addin nizar', 'L', 'kesehatan', '0897616615212', 'kulonprogo desa ngatiem'),
(3, 'Eka Windu Setiawati', 'P', 'Informatika', '081368758270', 'Magelang'),
(4, 'Nur Rahmat Adi ', 'L', 'Pisikologi', '085282366231', 'Purwodadi'),
(5, 'Amalia Khusnul', 'P', 'Manajemen', '087753627700', 'Bantul'),
(6, 'Vikiara ', 'P', 'Akutansi', '081351333691', 'Sleman'),
(7, 'Miftahul Rozak ', 'L', 'Perawat', '087781900321', 'Bantul'),
(8, 'Hima Rifti', 'P', 'Informatika', '085255520011', 'Cilacap'),
(9, 'Azhar amrullah', 'L', 'Elektro', '088900655433', 'Kuningan'),
(10, 'Luqman Hakim', 'L', 'Informatika', '083167777817', 'Magelang'),
(11, 'Berliana', 'P', 'Elektro', '081253322300', 'Kebumen'),
(12, 'Ageng Prabowo', 'P', 'Farmasi', '081356666800', 'Medan');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `penulis_buku` varchar(50) NOT NULL,
  `penerbit_buku` varchar(50) NOT NULL,
  `tahun_penerbit` char(4) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `penulis_buku`, `penerbit_buku`, `tahun_penerbit`, `stok`, `gambar`) VALUES
(1, 'Keajaiban Toko Kelontong ', 'Namiya Keigo Higashino', 'kolea nasaga', '2012', 12, 'https://i.postimg.cc/m2dySS4h/Keajaiban.jpg'),
(2, 'Paint', 'le hee young', 'erroakata', '2020', 15, 'https://i.postimg.cc/zBbG98b9/Paint.jpg'),
(3, 'Almost 10 Years Ago', 'Trini', 'memento', '2020', 12, 'https://i.postimg.cc/WzG0rMnp/Almost.jpg'),
(4, 'Kita Pergi Hari Ini', 'Ziggy', 'brizkie', '2011', 12, 'https://i.postimg.cc/25nWgQsQ/Kita.jpg'),
(5, 'Atomic Habits', 'James Clear', 'GM', '2018', 16, 'https://i.postimg.cc/8CdG2ctJ/Atomic.jpg'),
(6, 'Berani Tidak Disukai ', 'Ichiro Kishimi dan Fumitake', 'Koga', '2019', 18, 'https://i.postimg.cc/rwS7mbW7/Berani.jpg\r\n'),
(7, 'Bulan', 'Tere Liye', 'GM', '2015', 8, 'https://i.postimg.cc/ry78RB0p/Bulan.jpg'),
(8, 'Good Night Stories for Rebel Girl', 'Elena Favilli dan Francesca Cavallo', 'GM', '2016', 10, 'https://i.postimg.cc/gJwCY0KH/Good.jpg'),
(9, 'Harry Potter dan Batu Bertuah', 'J.K. Rowling', 'GM', '1997', 6, 'https://i.postimg.cc/zXp0crCz/Harry.jpg'),
(10, 'Loving The Wounded Soul', 'Regis Machdy', 'GM', '2019', 4, 'https://i.postimg.cc/4yjNJMtm/Loving.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `id_buku`, `id_anggota`, `id_petugas`) VALUES
(1, '2022-05-12', 3, 1, 5194),
(2, '2022-05-26', 10, 5, 5194);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `id_buku` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `tanggal_pinjam`, `tanggal_pengembalian`, `denda`, `id_buku`, `id_anggota`, `id_petugas`) VALUES
(3, '0000-00-00', '2022-05-15', 5000, 3, 1, 5194),
(6, '0000-00-00', '2022-05-31', NULL, 10, 5, 5194);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telp` char(13) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `email`, `pass`, `nama`, `no_telp`, `alamat`) VALUES
(5194, 'adi@gmail.com', '$2y$10$Tw9uPm2qGIh8JZeshIYfCuAPhP1dXOXgBIjCxqCPD.6lUXlsyt8S.', 'adi', '123456789', 'nkri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5195;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `pengembalian_ibfk_3` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
