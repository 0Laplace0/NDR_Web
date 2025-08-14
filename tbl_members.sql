-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 05:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `id` int(11) NOT NULL,
  `std_name` varchar(100) NOT NULL,
  `std_id` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`id`, `std_name`, `std_id`, `phone`, `profile_image`, `email`, `dateCreate`) VALUES
(2, 'Kritpanit Teerakaittikul', '2213110766', '0987978397', '208014548720250718_173251.jpg', 'kritpanit3162@gmail.com', '2025-07-18 15:19:49'),
(3, 'Test01', '2213110001', '0894346774', '180102907020250718_172802.jpg', 'Test01@gmail.com', '2025-07-18 15:28:02'),
(4, 'Test02', '2213110002', '0983335674', '150735281820250718_172847.jpg', 'Test02@gmail.com', '2025-07-18 15:28:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`std_name`),
  ADD UNIQUE KEY `std_id` (`std_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
