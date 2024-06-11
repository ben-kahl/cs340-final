-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el7.remi
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2024 at 08:08 PM
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
-- Table structure for table `LIBRARY_ADDR`
--

CREATE TABLE `LIBRARY_ADDR` (
  `addr_id` int(11) NOT NULL,
  `library_id` int(11) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `LIBRARY_ADDR`
--

INSERT INTO `LIBRARY_ADDR` (`addr_id`, `library_id`, `street`, `city`, `state`, `zip`) VALUES
(1, 1, '123 3rd Ave', 'Corvallis', 'OR', '97330'),
(2, 2, '123 cool st', 'coolville', 'CA', '94526'),
(3, 3, '789 East St', 'Corvallis', 'OR', '97330'),
(4, 4, '101 North St', 'Corvallis', 'OR', '97330'),
(5, 5, '202 South St', 'Corvallis', 'OR', '97330'),
(6, 6, '303 Downtown Ave', 'Corvallis', 'OR', '97330'),
(7, 7, '404 Uptown Blvd', 'Corvallis', 'OR', '97330'),
(8, 8, '505 Riverside Dr', 'Corvallis', 'OR', '97330'),
(9, 9, '606 Hillside Ln', 'Corvallis', 'OR', '97330'),
(10, 10, '707 Lakeside Ct', 'Corvallis', 'OR', '97330');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `LIBRARY_ADDR`
--
ALTER TABLE `LIBRARY_ADDR`
  ADD PRIMARY KEY (`addr_id`),
  ADD KEY `library_id` (`library_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `LIBRARY_ADDR`
--
ALTER TABLE `LIBRARY_ADDR`
  MODIFY `addr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `LIBRARY_ADDR`
--
ALTER TABLE `LIBRARY_ADDR`
  ADD CONSTRAINT `LIBRARY_ADDR_ibfk_1` FOREIGN KEY (`library_id`) REFERENCES `LIBRARY` (`library_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
