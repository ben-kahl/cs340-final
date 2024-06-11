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
-- Table structure for table `BORROWS`
--

CREATE TABLE `BORROWS` (
  `borrow_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `BORROWS`
--

INSERT INTO `BORROWS` (`borrow_id`, `member_id`, `book_id`, `date`) VALUES
(1, 1, 1, '2024-06-10'),
(2, 1, 1, '2024-06-12'),
(3, 12, 1, '2024-06-10'),
(4, 12, 1, '2024-06-10');

--
-- Triggers `BORROWS`
--
DELIMITER $$
CREATE TRIGGER `after_borrow_insert` AFTER INSERT ON `BORROWS` FOR EACH ROW BEGIN
    UPDATE BOOK
    SET available = 0
    WHERE book_id = NEW.book_id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BORROWS`
--
ALTER TABLE `BORROWS`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BORROWS`
--
ALTER TABLE `BORROWS`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `BORROWS`
--
ALTER TABLE `BORROWS`
  ADD CONSTRAINT `BORROWS_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `MEMBER` (`member_id`),
  ADD CONSTRAINT `BORROWS_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `BOOK` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
