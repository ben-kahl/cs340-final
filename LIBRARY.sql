-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el7.remi
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2024 at 08:07 PM
-- Server version: 10.6.17-MariaDB-log
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_kahlb`
--

-- --------------------------------------------------------

--
-- Table structure for table `LIBRARY`
--

CREATE TABLE `LIBRARY` (
  `library_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `LIBRARY`
--

INSERT INTO `LIBRARY` (`library_id`, `name`) VALUES
(1, 'Downtown Library'),
(2, 'the cooler library'),
(3, 'Eastside Branch'),
(4, 'Northside Branch'),
(5, 'Southside Branch'),
(6, 'Downtown Library'),
(7, 'Uptown Library'),
(8, 'Riverside Library'),
(9, 'Hillside Library'),
(10, 'Lakeside Library');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `LIBRARY`
--
ALTER TABLE `LIBRARY`
  ADD PRIMARY KEY (`library_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `LIBRARY`
--
ALTER TABLE `LIBRARY`
  MODIFY `library_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `LIBRARY`
--
ALTER TABLE `LIBRARY`
  ADD CONSTRAINT `LIBRARY_ibfk_1` FOREIGN KEY (`library_id`) REFERENCES `LIBRARY` (`library_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
