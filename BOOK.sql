-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el7.remi
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2024 at 08:06 PM
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
-- Table structure for table `BOOK`
--

CREATE TABLE `BOOK` (
  `book_id` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `length` int(11) NOT NULL,
  `library_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `BOOK`
--

INSERT INTO `BOOK` (`book_id`, `available`, `isbn`, `title`, `author`, `length`, `library_id`) VALUES
(1, 1, '9783161484100', 'The Great Gatsby', 'F. Scott Fitzgerald', 180, 1),
(2, 1, '9780743273565', 'To Kill a Mockingbird', 'Harper Lee', 281, 2),
(3, 1, '9780452284234', '1984', 'George Orwell', 328, 3),
(4, 1, '9780140177398', 'Of Mice and Men', 'John Steinbeck', 107, 4),
(5, 1, '9780743273566', 'The Catcher in the Rye', 'J.D. Salinger', 277, 5),
(6, 0, '9781476708696', 'The Road', 'Cormac McCarthy', 287, 6),
(7, 1, '9780061120084', 'Brave New World', 'Aldous Huxley', 268, 7),
(8, 1, '9780307594607', 'The Book Thief', 'Markus Zusak', 552, 8),
(9, 1, '9780452284241', 'Fahrenheit 451', 'Ray Bradbury', 194, 9),
(10, 1, '9780743273572', 'Moby-Dick', 'Herman Melville', 635, 10),
(11, 1, '1234567890123', 'curious george', 'george', 10, 2),
(13, 1, '123456789012', 'test', 'test', 1234, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BOOK`
--
ALTER TABLE `BOOK`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `library_id` (`library_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BOOK`
--
ALTER TABLE `BOOK`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `BOOK`
--
ALTER TABLE `BOOK`
  ADD CONSTRAINT `BOOK_ibfk_1` FOREIGN KEY (`library_id`) REFERENCES `LIBRARY` (`library_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
