-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2020 at 11:38 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skyware_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE `tree` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `first` varchar(50) NOT NULL,
  `second` varchar(50) NOT NULL,
  `third` varchar(50) NOT NULL,
  `fourth` varchar(110) NOT NULL,
  `fifth` varchar(110) NOT NULL,
  `sixth` varchar(110) NOT NULL,
  `firstcount` int(11) NOT NULL,
  `secondcount` int(11) NOT NULL,
  `thirdcount` int(11) NOT NULL,
  `fourthcount` int(11) NOT NULL,
  `fifthcount` int(11) NOT NULL,
  `sixthcount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`id`, `userid`, `first`, `second`, `third`, `fourth`, `fifth`, `sixth`, `firstcount`, `secondcount`, `thirdcount`, `fourthcount`, `fifthcount`, `sixthcount`) VALUES
(1, 'sponsor@mail.com', 'd1@mail.com', 'd2@mail.com', 'd3@mail.com', 'd4@mail.com', 'd5@mail.com', 'd6@mail.com', 4, 4, 1, 1, 1, 1),
(2, 'd1@mail.com', 'd7@mail.com', 'd8@mail.com', 'd9@mail.com', '', '', '', 1, 1, 1, 0, 0, 0),
(3, 'd2@mail.com', '', '', '', 'd10@mail.com', 'd11@mail.com', 'd12@mail.com', 0, 0, 0, 1, 1, 1),
(4, 'd3@mail.com', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(5, 'd4@mail.com', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(6, 'd5@mail.com', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(7, 'd6@mail.com', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(8, 'd7@mail.com', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(9, 'd8@mail.com', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(10, 'd9@mail.com', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(11, 'd10@mail.com', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(12, 'd11@mail.com', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(13, 'd12@mail.com', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(122) NOT NULL,
  `address` text NOT NULL,
  `under_userid` varchar(50) NOT NULL,
  `side` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `mobile`, `role`, `status`, `address`, `under_userid`, `side`) VALUES
(1, 'Sponsor', 'sponsor@mail.com', '12345678', '12345678', 'admin', '', '', '', ''),
(2, 'D1', 'd1@mail.com', '123456', '1234567', 'user', 'active', '12 dgdfdf', 'sponsor@mail.com', 'first'),
(3, 'D2', 'd2@mail.com', '123456', '1234567', 'user', 'active', 'nsnsa,s', 'sponsor@mail.com', 'second'),
(4, 'D3', 'd3@mail.com', '123456', '1234567', 'user', 'active', '12 dgdfdf', 'sponsor@mail.com', 'third'),
(5, 'D1a', 'd4@mail.com', '123456', '1234567', 'user', 'active', '12 dgdfdf', 'sponsor@mail.com', 'fourth'),
(6, 'D1b', 'd5@mail.com', '123456', '1234567', 'user', 'active', 'nsnsas', 'sponsor@mail.com', 'fifth'),
(7, 'D1c', 'd6@mail.com', '0908321', '0908321', 'user', 'active', '12 dgdfdf', 'sponsor@mail.com', 'sixth'),
(8, 'D2a', 'd7@mail.com', '1234567', '1234567', 'user', 'active', 'nsnsas', 'd1@mail.com', 'first'),
(9, 'D2b', 'd8@mail.com', '1234567', '1234567', 'user', 'active', 'nsnsas', 'd1@mail.com', 'second'),
(10, 'D2c', 'd9@mail.com', '1234567', '1234567', 'user', 'active', 'nsnsas', 'd1@mail.com', 'third'),
(11, 'D3a', 'd10@mail.com', '0908321', '0908321', 'user', 'active', 'nsnsas', 'd2@mail.com', 'fourth'),
(12, 'D3b', 'd11@mail.com', '0908321', '0908321', 'user', 'active', 'nsnsas', 'd2@mail.com', 'fifth'),
(13, 'D3c', 'd12@mail.com', '0908321', '0908321', 'user', 'active', 'nsnsas', 'd2@mail.com', 'sixth'),
(14, 'D4a', 'd13@mail.com', '12345', '12345', 'user', 'pending', 'eddfdfdd', '', ''),
(15, 'D4b', 'd14@mail.com', '123456', '123456', 'user', 'pending', 'wefffefef', '', ''),
(16, 'D4c', 'd15@mail.com', '123456', '123456', 'user', 'pending', 'wedwdwwwd', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tree`
--
ALTER TABLE `tree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tree`
--
ALTER TABLE `tree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
