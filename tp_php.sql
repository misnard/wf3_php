-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2017 at 03:17 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp_php`
--
CREATE DATABASE IF NOT EXISTS `tp_php` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tp_php`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `posted` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `posted`, `picture`, `author`) VALUES
(1, 'Article bobo0', 'Lorem sa mere', '06.09.17', 'pic01.jpg', 'Connasse parisienne'),
(2, 'Article bobo1', 'Lorem sa mere', '06.09.17', 'pic01.jpg', 'Connasse parisienne'),
(3, 'Article bobo2', 'Lorem sa mere', '06.09.17', 'pic01.jpg', 'Connasse parisienne'),
(4, 'Article bobo3', 'Lorem sa mere', '06.09.17', 'pic01.jpg', 'Connasse parisienne'),
(5, 'Article bobo4', 'Lorem sa mere', '06.09.17', 'pic01.jpg', 'Connasse parisienne'),
(6, 'Article bobo5', 'Lorem sa mere', '06.09.17', 'pic01.jpg', 'Connasse parisienne'),
(7, 'Article bobo6', 'Lorem sa mere', '06.09.17', 'pic01.jpg', 'Connasse parisienne'),
(8, 'Article bobo7', 'Lorem sa mere', '06.09.17', 'pic01.jpg', 'Connasse parisienne'),
(9, 'Article bobo8', 'Lorem sa mere', '06.09.17', 'pic01.jpg', 'Connasse parisienne'),
(10, 'Article bobo9', 'Lorem sa mere', '06.09.17', 'pic01.jpg', 'Connasse parisienne');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
