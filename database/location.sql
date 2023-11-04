-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 04, 2023 at 09:23 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IE4717_ainzs_theatres`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `address`, `image`) VALUES
(1, 'AZT Funan', '107 North Bridge road, #05-01, Funan Mall, Singapore 179105', 'funan.webp'),
(2, 'AZT Vivo', '1 HarbourFront Walk, #02-30, VivoCity, Singapore 098585', 'vivo.jpeg'),
(3, 'AZT Tiong Bahru Plaza', '302 Tiong Bahru Road, #04-105, Tiong Bahru Plaza, Singapore 168732', 'tiongBahru.jpeg'),
(4, 'AZT Bugis+', '201 Victoria Street #05-01 Bugis+ Singapore 188067', 'bugis.jpeg'),
(5, 'AZT Bedok', '445 Bedok North Street 1, #04-01, Djitsun Mall Bedok, Singapore 469661', 'bedok.jpeg'),
(6, 'AZT Tampines', '4 Tampines Central, #04-17/18, Tampines Mall Shopping Centre, Singapore 529510', 'tampines.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
