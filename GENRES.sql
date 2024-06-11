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
-- Table structure for table `GENRES`
--

CREATE TABLE `GENRES` (
  `genre_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `genre_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `GENRES`
--

INSERT INTO `GENRES` (`genre_id`, `book_id`, `genre_name`) VALUES
(1, 1, 'Fiction'),
(2, 2, 'Classic'),
(3, 3, 'Dystopian'),
(4, 4, 'Literature'),
(5, 5, 'Coming-of-age'),
(6, 6, 'Post-apocalyptic'),
(7, 7, 'Science Fiction'),
(8, 8, 'Historical Fiction'),
(9, 9, 'Science Fiction'),
(10, 10, 'Adventure');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `GENRES`
--
ALTER TABLE `GENRES`
  ADD PRIMARY KEY (`genre_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `GENRES`
--
ALTER TABLE `GENRES`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `GENRES`
--
ALTER TABLE `GENRES`
  ADD CONSTRAINT `GENRES_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `BOOK` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
