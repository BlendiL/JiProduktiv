-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 08:57 PM
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
-- Database: `jiproduktiv`
--

-- --------------------------------------------------------

--
-- Table structure for table `anetaret`
--

CREATE TABLE `anetaret` (
  `ID_Anetari` int(11) NOT NULL,
  `ID_Perdoruesi` int(11) NOT NULL,
  `ID_Room` int(11) NOT NULL,
  `Niveli` tinyint(1) NOT NULL,
  `Casja` tinyint(1) DEFAULT NULL,
  `Statusi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anetaret`
--

INSERT INTO `anetaret` (`ID_Anetari`, `ID_Perdoruesi`, `ID_Room`, `Niveli`, `Casja`, `Statusi`) VALUES
(5, 1, 1, 0, NULL, NULL),
(8, 7, 1, 0, NULL, NULL),
(9, 2, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detyrat`
--

CREATE TABLE `detyrat` (
  `ID_Detyrat` int(11) NOT NULL,
  `Detyra` varchar(255) NOT NULL,
  `ShpjegimiDetyres` varchar(4096) DEFAULT NULL,
  `Emri_i_Files` varchar(255) DEFAULT NULL,
  `File` longblob DEFAULT NULL,
  `Afati_Deri` datetime DEFAULT NULL,
  `Niveli_Prioritetit` int(11) NOT NULL,
  `ID_TeamLead` int(11) NOT NULL,
  `ID_Perdoruesi` int(11) DEFAULT NULL,
  `ID_Room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detyrat`
--

INSERT INTO `detyrat` (`ID_Detyrat`, `Detyra`, `ShpjegimiDetyres`, `Emri_i_Files`, `File`, `Afati_Deri`, `Niveli_Prioritetit`, `ID_TeamLead`, `ID_Perdoruesi`, `ID_Room`) VALUES
(2, 'aa', NULL, NULL, NULL, NULL, 0, 2, 1, 1),
(3, 'aa', NULL, NULL, NULL, NULL, 0, 2, 7, 1),
(4, 'aa', NULL, NULL, NULL, NULL, 0, 2, 2, 1),
(5, 'aa', NULL, NULL, NULL, NULL, 0, 2, 7, 1),
(6, 'aa', NULL, NULL, NULL, NULL, 0, 2, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `ID_Room` int(11) NOT NULL,
  `Titulli` varchar(255) NOT NULL,
  `Prej` datetime NOT NULL,
  `Deri` datetime NOT NULL,
  `ID_Perdoruesi` int(11) NOT NULL,
  `kodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`ID_Room`, `Titulli`, `Prej`, `Deri`, `ID_Perdoruesi`, `kodi`) VALUES
(1, 'Per', '2024-01-15 02:04:46', '2024-01-22 01:04:46', 2, ''),
(2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, ''),
(3, 'aaa', '2024-01-17 01:40:00', '2024-01-17 01:40:00', 2, ''),
(4, 'aaabb', '2024-01-17 04:40:00', '2024-01-17 01:40:00', 2, ''),
(5, 'Jip', '2024-01-18 13:33:00', '2024-01-26 13:37:00', 2, ''),
(6, 'aaa', '2024-01-17 23:32:57', '2024-01-17 23:32:57', 7, 'bf415a7e9a2da22853aceaac2a2882f209cda9a1f5f718b44f77f05dbb86fdb9124589ae'),
(7, 'Detyra te zgjedhura', '2024-01-18 23:49:00', '2024-01-19 23:51:00', 2, 'a5b40f23be67a062808b54a8e62797e9792504d50d87711bd5d5026423d501f44c70a172'),
(8, 'aa', '2024-01-10 00:47:00', '2024-01-02 00:47:00', 2, '5314777b15e9add69b2c214007cd21d6ce5d16ac1c9d12d161bf7b4eaff95444f742c53f'),
(9, 'ahahahahah', '2024-01-17 16:06:00', '2024-01-18 16:06:00', 2, '61dee9962f6b0e958c74ce5b163822d4dcf653b5b00755db543295c53a99e03ccddac9a1');

--
-- Triggers `room`
--
DELIMITER $$
CREATE TRIGGER `before_insert_room` BEFORE INSERT ON `room` FOR EACH ROW BEGIN
    SET NEW.kodi = CONCAT(SHA1(UUID()), MD5(CONCAT(NOW(), RAND())));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `ID_Perdoruesi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statusi_detyres`
--

CREATE TABLE `statusi_detyres` (
  `ID_Statusi` int(11) NOT NULL,
  `Statusi` varchar(255) NOT NULL,
  `ID_Detyra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_Perdoruesi` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Telefoni` int(15) NOT NULL,
  `EmriFotos` varchar(50) DEFAULT NULL,
  `Foto` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_Perdoruesi`, `first_name`, `last_name`, `email`, `password`, `Telefoni`, `EmriFotos`, `Foto`) VALUES
(1, 'Lirik', 'Ismajli', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 0, NULL, NULL),
(2, 'Avdi', 'Ajvazi', 'avdiajvazi1@outlook.com', '202cb962ac59075b964b07152d234b70', 0, NULL, NULL),
(7, 'aa', 'bb', 'abb@abb.com', '202cb962ac59075b964b07152d234b70', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anetaret`
--
ALTER TABLE `anetaret`
  ADD PRIMARY KEY (`ID_Anetari`),
  ADD KEY `ID_Room` (`ID_Room`),
  ADD KEY `ID_Perdoruesi` (`ID_Perdoruesi`);

--
-- Indexes for table `detyrat`
--
ALTER TABLE `detyrat`
  ADD PRIMARY KEY (`ID_Detyrat`),
  ADD KEY `ID_Room` (`ID_Room`),
  ADD KEY `ID_TeamLead` (`ID_TeamLead`),
  ADD KEY `ID_Perdoruesi` (`ID_Perdoruesi`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ID_Room`),
  ADD KEY `ID_Perdoruesi` (`ID_Perdoruesi`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Perdoruesi` (`ID_Perdoruesi`);

--
-- Indexes for table `statusi_detyres`
--
ALTER TABLE `statusi_detyres`
  ADD PRIMARY KEY (`ID_Statusi`),
  ADD KEY `ID_Detyra` (`ID_Detyra`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_Perdoruesi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anetaret`
--
ALTER TABLE `anetaret`
  MODIFY `ID_Anetari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detyrat`
--
ALTER TABLE `detyrat`
  MODIFY `ID_Detyrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `ID_Room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statusi_detyres`
--
ALTER TABLE `statusi_detyres`
  MODIFY `ID_Statusi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_Perdoruesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anetaret`
--
ALTER TABLE `anetaret`
  ADD CONSTRAINT `anetaret_ibfk_2` FOREIGN KEY (`ID_Room`) REFERENCES `room` (`ID_Room`),
  ADD CONSTRAINT `anetaret_ibfk_3` FOREIGN KEY (`ID_Perdoruesi`) REFERENCES `user` (`ID_Perdoruesi`);

--
-- Constraints for table `detyrat`
--
ALTER TABLE `detyrat`
  ADD CONSTRAINT `detyrat_ibfk_1` FOREIGN KEY (`ID_Room`) REFERENCES `room` (`ID_Room`),
  ADD CONSTRAINT `detyrat_ibfk_2` FOREIGN KEY (`ID_TeamLead`) REFERENCES `user` (`ID_Perdoruesi`),
  ADD CONSTRAINT `detyrat_ibfk_3` FOREIGN KEY (`ID_Perdoruesi`) REFERENCES `user` (`ID_Perdoruesi`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`ID_Perdoruesi`) REFERENCES `user` (`ID_Perdoruesi`);

--
-- Constraints for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD CONSTRAINT `schedule_list_ibfk_1` FOREIGN KEY (`ID_Perdoruesi`) REFERENCES `user` (`ID_Perdoruesi`);

--
-- Constraints for table `statusi_detyres`
--
ALTER TABLE `statusi_detyres`
  ADD CONSTRAINT `statusi_detyres_ibfk_1` FOREIGN KEY (`ID_Detyra`) REFERENCES `detyrat` (`ID_Detyrat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
