-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 03:03 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jtevent`
--

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_akhir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama`, `konten`, `img`, `logo`, `waktu_mulai`, `waktu_akhir`) VALUES
(24, 'Tes', '<div>asda sada asda asda asda sdasd asda asdas asdad adsdadsa sadasdsa asdsadas dasasdasd adsad asdasdasd daadsad asdasdasd adsadsasd daasdasd adssadasd asdsad asdsadsad asdasd addsaasd asdasdasd sad asda sda sda sdsa dsad asd as d sad asd as dsaasdad asda s dadsas asasdasd das sda</div>', '/github/JTI-Event/img/event/img-1580010559.png', '', '2023-06-09 11:36:00', '2023-06-10 14:36:00'),
(25, 'Tes', '<div>adaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsaadaadsdadsasadsa</div>', '', '', '2023-06-08 10:37:00', '2023-06-09 12:37:00'),
(27, 'TESSTSTST', '<div>asdadas asd ad as a asdadas a adasadsasdasd as aa&nbsp; a sddsasadsaasddsa a daads as a a ads dsadsa sasadsda dsasad&nbsp; asads sad assad asd sadsaas sa saddsasad a dsas asdsdaasdadsasd&nbsp; da adsasdsaddassa s sdasdaasdsdasasad assdasdaasdsadasd&nbsp; saasdsadsadasdad&nbsp; sasdaasdasdsad sdasdasdadsasdad sadasadsadssadadsasdasd sdaasdsadasassad asdasdasdasdasdasdsad sadasdasdads</div>', '/github/JTI-Event/img/event/img-8493812.jpeg', '', '2023-06-08 10:58:00', '2023-06-08 12:59:00'),
(28, 'ababab', '', '/github/JTI-Event/img/event/img-1403932154.jpeg', '', '2023-06-08 15:01:00', '2023-06-09 16:01:00'),
(29, 'SPARTA', '<div>Orang apa yang bisa berenang tanpa bergerak. dia pasti bukan orang</div>', '/github/JTI-Event/img/event/img1284726963.png', '', '2023-06-14 13:38:00', '2023-06-21 20:38:00'),
(30, 'Ended', '<div>laosdjds asd sda sadasd asd asd sad sda as dsa sad asd</div>', '', '', '2023-06-13 13:39:00', '2023-06-14 13:39:00'),
(31, 'Ended Jauhh', '<div>saasd adaadssd ddsa asasds asaddsa ass asdasadsd sa asdsda sdad dsa sdasda sasadsasddsa dsa&nbsp;</div>', '', '', '2023-06-09 14:49:00', '2023-06-11 16:49:00'),
(32, 'Started Jauh', '<div>sda d saads dasd saadsdasasdsadsda sad sa dasddsa sda</div>', '', '', '2023-06-08 15:50:00', '2023-06-15 17:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_user`
--

CREATE TABLE `kegiatan_user` (
  `kegiatan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan_user`
--

INSERT INTO `kegiatan_user` (`kegiatan_id`, `user_id`) VALUES
(24, -1835373924);

-- --------------------------------------------------------

--
-- Table structure for table `penilai`
--

CREATE TABLE `penilai` (
  `id` int(11) NOT NULL,
  `kegiatan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `skor`
--

CREATE TABLE `skor` (
  `id` int(11) NOT NULL,
  `kegiatan` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `penilai` int(11) NOT NULL,
  `skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama`, `alamat`, `email`, `password`, `role`) VALUES
(-1835373924, 'peserta', 'peserta', 'Darjo', 'ucok@polinema.ac.id', '$2y$10$fkyTndnrTNb7OeUOCtZevOk0xuWFQYL9Vc7zSB39.UnpnTeB.DnfK', 0),
(646028614, 'user', 'user12', 'alamat12', '1email@email.com', '$2y$10$zYta/6LPnw/k3uoXmXyGIO3AH6RiC6tJmHBG53z5nRAvIIOXvCZFm', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan_user`
--
ALTER TABLE `kegiatan_user`
  ADD PRIMARY KEY (`kegiatan_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `penilai`
--
ALTER TABLE `penilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan` (`kegiatan`);

--
-- Indexes for table `skor`
--
ALTER TABLE `skor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan` (`kegiatan`),
  ADD KEY `user` (`user`),
  ADD KEY `penilai` (`penilai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `penilai`
--
ALTER TABLE `penilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skor`
--
ALTER TABLE `skor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=646028615;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kegiatan_user`
--
ALTER TABLE `kegiatan_user`
  ADD CONSTRAINT `kegiatan_user_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`),
  ADD CONSTRAINT `kegiatan_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `penilai`
--
ALTER TABLE `penilai`
  ADD CONSTRAINT `penilai_ibfk_1` FOREIGN KEY (`kegiatan`) REFERENCES `kegiatan` (`id`);

--
-- Constraints for table `skor`
--
ALTER TABLE `skor`
  ADD CONSTRAINT `skor_ibfk_1` FOREIGN KEY (`kegiatan`) REFERENCES `penilai` (`id`),
  ADD CONSTRAINT `skor_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `skor_ibfk_3` FOREIGN KEY (`penilai`) REFERENCES `penilai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
