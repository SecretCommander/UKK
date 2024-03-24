-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 04:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galeri`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `levelA` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `nama`, `username`, `password`, `telp`, `levelA`) VALUES
(1, 'farrel ardan', 'farrrel', '270306rel', '081263647330', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `albumid` int(11) NOT NULL,
  `nama_album` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumid`, `nama_album`, `deskripsi`, `tanggal_dibuat`, `userid`) VALUES
(13, 'Cerita Kita', 'this is about us, ours memories\\r\\n', '2024-03-16 16:50:16', 11),
(16, 'kesukaanku', 'apa yang kusuka?', '2024-03-21 10:32:24', 8),
(19, 'Chill', 'waktuku', '2024-03-22 23:57:55', 1),
(20, 'Nature', 'Alam itu indah dengan kamu didalamnya', '2024-03-23 00:13:05', 1),
(21, 'Things', 'hanya sebuah BENDA', '2024-03-23 22:36:50', 12),
(22, 'Tes Mobile', 'Don&#039;t mind the title', '2024-03-23 23:22:47', 13),
(23, 'Another', 'Lainnya', '2024-03-23 23:26:36', 13),
(24, 'Saingan X', 'Tentang makanan hehe', '2024-03-23 23:34:34', 14);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `fotoid` int(11) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `deskripsi_foto` text NOT NULL,
  `tanggal_unggah` datetime NOT NULL DEFAULT current_timestamp(),
  `lokasi_file` varchar(255) NOT NULL,
  `albumid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `kategori` set('santai','alam','kuliner','benda') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`fotoid`, `judul_foto`, `deskripsi_foto`, `tanggal_unggah`, `lokasi_file`, `albumid`, `userid`, `kategori`) VALUES
(14, 'Aku dan Kamu', ' Aku adalah seseorang yang senang menjelajahi dunia dengan mata yang penuh semangat, terpesona oleh keindahan yang tak terhitung jumlahnya di sekitar. Anda adalah seorang pembelajar yang tak pernah lelah, selalu mencari pengetahuan baru dan pengalaman yang mendalam untuk menambah warna dalam kehidupanku. Kamu, disisi lain, adalah sosok yang penuh kehangatan dan kebaikan, seseorang yang selalu memberikan senyuman yang menyenangkan hati. Kamu memiliki daya tarik yang tak tertandingi, mampu membuat orang di sekitarmu merasa nyaman dan dihargai. Bersamamu, setiap momen menjadi lebih berarti dan penuh keceriaan.', '2024-03-16 16:58:42', '11/Cerita Kita/65f56d52f07e0.jpg', 13, 11, 'santai'),
(21, 'Me ft friends', 'Our Memories', '2024-03-23 00:00:49', '1/Chill/65fdb9410028a.jpeg', 19, 1, 'santai'),
(22, 'Star Wars vibe', 'Star wars world building is one of the top!!!!', '2024-03-23 22:00:54', '1/Nature/65feeea64350a.jpg', 20, 1, 'alam'),
(23, 'Dark Night', 'langit malam just cool & calmy', '2024-03-23 22:10:28', '1/Nature/65fef0e43cf5b.jpeg', 20, 1, 'alam'),
(24, 'pen-duduk', 'tempat duduk crafts DIY', '2024-03-23 22:40:46', '12/Things/65fef7fe743c9.jpeg', 21, 12, 'benda'),
(25, 'plushies', 'to sleep, sleep, and sleeeppp...', '2024-03-23 22:48:06', '12/Things/65fef9b62cbab.jpeg', 21, 12, 'benda'),
(26, 'butterfly batarang', 'i am batman!!!', '2024-03-23 22:50:47', '12/Things/65fefa5746574.jpeg', 21, 12, 'benda'),
(27, 'ganci bebeks', 'bebeks : peace never an option now..', '2024-03-23 22:58:01', '12/Things/65fefc09e677f.jpeg', 21, 12, 'benda'),
(28, 'im groot', 'im groooottt', '2024-03-23 23:01:17', '8/kesukaanku/65fefccdd66f7.jpg', 16, 8, 'santai'),
(29, 'Sate vadang', 'makanan favoritkuh, 1 and only Sateh', '2024-03-23 23:05:55', '8/kesukaanku/65fefde320fe7.jpeg', 16, 8, 'kuliner'),
(30, 'Indonesia?', 'looks very beautiful just like you :)', '2024-03-23 23:10:02', '8/kesukaanku/65fefedae20d6.jpeg', 16, 8, 'alam'),
(31, 'Sov buah', 'Favourite drinkk', '2024-03-23 23:13:40', '8/kesukaanku/65feffb4c2b7d.jpeg', 16, 8, 'kuliner'),
(32, 'School', 'School vibe nature', '2024-03-23 23:24:59', '13/Tes Mobile/65ff025b7c403.jpg', 22, 13, 'alam'),
(33, 'Chill Cat', 'Kucing diatas kursi sedang bersantai sambil mendengarkan lagu Taylor Swift ', '2024-03-23 23:30:54', '13/Another/65ff03be4eb90.jpeg', 23, 13, 'santai'),
(34, 'Kue lapis person', 'Ayou tes Cakeresume mu seru loh wkwkwkwk', '2024-03-23 23:36:17', '14/Saingan X/65ff0501338dd.jpg', 24, 14, 'kuliner'),
(35, 'Bola Ijok', 'Manis, kenyal, enak dah pokoknya', '2024-03-23 23:38:39', '14/Saingan X/65ff058fa3d6f.jpeg', 24, 14, 'kuliner');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `komentarid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`komentarid`, `fotoid`, `userid`, `isi_komentar`, `tanggal_komentar`) VALUES
(16, 14, 8, 'haiii komen dong ', '2024-03-18 14:49:41'),
(31, 14, 8, 'haloo', '2024-03-21 11:00:10'),
(34, 14, 1, 'hai', '2024-03-22 23:44:10'),
(35, 21, 1, 'Cool', '2024-03-23 22:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `likeid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggal_like` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`likeid`, `fotoid`, `userid`, `tanggal_like`) VALUES
(39, 14, 1, '2024-03-16 16:59:35'),
(44, 22, 12, '2024-03-23 22:46:16'),
(45, 14, 12, '2024-03-23 22:46:21'),
(46, 26, 12, '2024-03-23 22:58:10'),
(47, 14, 8, '2024-03-23 23:00:11'),
(48, 27, 8, '2024-03-23 23:00:14'),
(49, 22, 8, '2024-03-23 23:00:16'),
(50, 29, 8, '2024-03-23 23:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile` varchar(150) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `profile`, `password`, `email`, `nama_lengkap`, `alamat`) VALUES
(1, 'admin', '65fedd1b2094a.png', 'admin', 'admin@gmail.com', 'admin kerennn', 'Jl. abadi Komp. Abadi Residence No. c10'),
(8, 'farrel', '65fefc8207ef8.jfif', '12345678', 'farrelfff2@gmail.com', 'farrel ardan', 'Jl.Abadi'),
(11, 'yasuo', NULL, '123456789', 'lol@gmail.com', 'Yasuo and yone', 'jl. dragon lane'),
(12, 'FAD', '65fef6cf53714.jpg', '87654321', 'fadh1l@gmail.com', 'Fadhil ...', 'jl. ringroad'),
(13, 'Anakin', '65ff01ac0f5bf.png', 'star1234', 'anakinvader@gmail.com', 'Anakin Skywalker ', 'Jl. Planet'),
(14, 'Random', NULL, 'future12', 'ztwitter@gmail.com', 'Elon musk', 'Jl. New York ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`fotoid`),
  ADD KEY `albumid` (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`komentarid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`likeid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`albumid`) REFERENCES `album` (`albumid`),
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`),
  ADD CONSTRAINT `likefoto_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
