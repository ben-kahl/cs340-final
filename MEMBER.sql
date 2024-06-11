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
-- Table structure for table `MEMBER`
--

CREATE TABLE `MEMBER` (
  `member_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `date_joined` date NOT NULL,
  `library_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `MEMBER`
--

INSERT INTO `MEMBER` (`member_id`, `fname`, `lname`, `dob`, `date_joined`, `library_id`) VALUES
(1, 'John', 'Doe', '1998-04-09', '2020-01-01', 1),
(2, 'Jane', 'Smith', '1985-08-20', '2019-03-10', 2),
(3, 'Michael', 'Johnson', '1995-12-10', '2021-06-05', 3),
(4, 'Emily', 'Williams', '1982-07-25', '2018-11-20', 4),
(5, 'William', 'Brown', '1978-04-30', '2017-09-15', 5),
(6, 'Sarah', 'Jones', '1992-10-05', '2019-12-28', 6),
(7, 'Daniel', 'Garcia', '1987-03-18', '2020-02-14', 7),
(8, 'Jessica', 'Martinez', '1989-09-12', '2021-04-03', 8),
(9, 'David', 'Hernandez', '1998-01-08', '2022-01-20', 9),
(10, 'Amanda', 'Young', '1980-06-22', '2016-07-10', 10),
(12, 'pim', 'charlie', '2024-06-10', '2024-06-10', 1),
(13, 'tim', 'jones', '2024-06-11', '2024-06-11', 10),
(14, 'bill', 'frank', '2024-06-11', '2024-06-11', 10),
(15, 'test', 'man', '2024-06-11', '2024-06-11', 10),
(16, 'bill', 'q', '2024-06-11', '2024-06-11', 10),
(20, 'tom', 'cruise', '2024-06-11', '2024-06-11', 10),
(21, 'edd', 'eddy', '2024-06-11', '2024-06-11', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `MEMBER`
--
ALTER TABLE `MEMBER`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `library_id` (`library_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `MEMBER`
--
ALTER TABLE `MEMBER`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `MEMBER`
--
ALTER TABLE `MEMBER`
  ADD CONSTRAINT `MEMBER_ibfk_1` FOREIGN KEY (`library_id`) REFERENCES `LIBRARY` (`library_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
