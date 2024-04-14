-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 02:09 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notes`
--

CREATE TABLE `tbl_notes` (
  `n_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `n_title` varchar(50) NOT NULL,
  `n_content` mediumtext NOT NULL,
  `n_date` date NOT NULL,
  `favorite` tinyint(1) DEFAULT 0,
  `archived` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notes`
--

INSERT INTO `tbl_notes` (`n_id`, `id`, `n_title`, `n_content`, `n_date`, `favorite`, `archived`) VALUES
(34, 2, '12323', '13123', '2024-04-09', 1, 0),
(38, 1, 'jh', 'hgfh\r\n', '2024-04-05', 1, 0),
(44, 5, 'dsfdsfdsf', 'sdfsd', '2024-04-05', 1, 0),
(54, 4, 'thhthf', 'hghfghfgh', '2024-04-05', 1, 0),
(56, 5, 'dsadsa', 'dsadas', '2024-04-05', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `imgpath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `imgpath`) VALUES
(1, 'peter', '2@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'uploads/SHESH-1-66155b58546572.13402443_432724415_4289769214578681_2692676894361894885_n.jpg'),
(2, '22', '1dasd2@gmail.com', '224f6d5086b0e5cb996109d0d74c83b3', 'uploads/SHESH-123-66155c07bdb9e2.05873118_432724415_4289769214578681_2692676894361894885_n-removebg-preview.png'),
(3, '      2', 'john@gmail.com', '0192023a7bbd73250516f069df18b500', ''),
(4, 'john', 'berna@gmail.com', '0192023a7bbd73250516f069df18b500', 'uploads/SHESH-john-660fc963bb3545.50216012_bsit.jpg'),
(5, 'axa', 'axa@gmail.com', '0192023a7bbd73250516f069df18b500', 'uploads/SHESH-axa-66100c334070a4.48311853_apollo.png'),
(6, 'edwin', 'eduaneortega@gmail.com', '0192023a7bbd73250516f069df18b500', '');

--
-- Triggers `user_form`
--
DELIMITER $$
CREATE TRIGGER `update_user_name_trigger` AFTER UPDATE ON `user_form` FOR EACH ROW BEGIN
    IF NEW.name <> OLD.name THEN
        SET @new_user_name = NEW.name;
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  ADD CONSTRAINT `tbl_notes_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
