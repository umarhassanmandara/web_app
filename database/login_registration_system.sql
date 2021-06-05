-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2020 at 07:08 AM
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
-- Database: `login_registration_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(15) NOT NULL,
  `user_last_name` varchar(15) NOT NULL,
  `user_email` varchar(35) NOT NULL,
  `user_password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_password`) VALUES
(3, 'Md Ajmin', 'Pradhan', 'md.ajminpradhan@outlook.com', 'ajminpradhan'),
(4, 'Ariyan', 'Tanvir', 'ariyantanvir@protonmail.com', 'ariyantanvir'),
(5, 'Golam', ' Hider', 'hiderahmed@outlook.com', 'imhider'),
(6, 'Tushar', ' Ahmed', 'mr.prodhan912@gmail.com', 'imtushar'),
(7, 'MD Ajmin', ' Pradhan', 'mr.ajminpradhan@gmail.com', 'ajminpradhan'),
(8, 'dark', ' shadow', 'darkshadow@mymail.net', 'darkshadow'),
(9, 'Tamim Iqbal', ' Riyad', 'tamimiqbalriyad@mymail.net', 'tamimiqbalriyad@mymail.net'),
(10, 'Ariyan', ' Ahmed', 'ariyantanvir@mymail.net', 'jacksparow');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
