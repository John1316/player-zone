-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2020 at 03:47 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `playerzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `uname` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `uname`, `pass`) VALUES
(1, 'admin1', 'A@tota1234'),
(2, 'admin2', 'A@shika852'),
(3, 'admin3', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `playfields`
--

CREATE TABLE `playfields` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `des` varchar(500) NOT NULL,
  `hours` varchar(255) NOT NULL,
  `image` mediumtext NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `requested_playfield`
--

CREATE TABLE `requested_playfield` (
  `requested_id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hours_available` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `playfield_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `hours` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `uprice` int(255) NOT NULL,
  `reservation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `play_status` varchar(255) NOT NULL,
  `date_reservation` varchar(255) NOT NULL,
  `time_reservation` varchar(255) NOT NULL,
  `visa` varchar(255) NOT NULL,
  `notification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `playfield_id` int(255) NOT NULL,
  `users_id` int(255) NOT NULL,
  `scale` varchar(255) NOT NULL,
  `msg` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `value` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `full_name`, `uname`, `phone`, `pass`) VALUES
(1, 'John', 'john44', '01149917963', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(2, 'Danial', 'dany10', '01112223333', '8cb2237d0679ca88db6464eac60da96345513964'),
(3, 'Mariam', 'mariam5', '01222222222', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(4, 'Felfel', 'fefel6', '01149985852', '8cb2237d0679ca88db6464eac60da96345513964'),
(5, 'Claire', 'claire1', '01222244558', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(6, 'Berbara', 'berbara1', '01122112217', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(7, 'Mary', 'mary77', '01222222228', '20eabe5d64b0e216796e834f52d61fd0b70332fc'),
(8, 'John', 'john66', '01090762488', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441'),
(9, 'Veronica', 'vero26', '01211104243', '20eabe5d64b0e216796e834f52d61fd0b70332fc'),
(17, 'Ahmed', 'asameh04', '01095504951', '7c222fb2927d828af22f592134e8932480637c0d'),
(18, 'Sergio', 'ramos4', '01005504951', '7c222fb2927d828af22f592134e8932480637c0d'),
(19, 'Pola', 'tod', '01110117643', 'eaa6f1b7c4b2252ff252f370a0475aeec6f554e6'),
(20, 'jonjon', 'john888', '01234567892', '667a25b0855ad6bc24c4547775c848d87cb93ba2'),
(21, 'Fady Fwazy', 'fadyfwazy12', '0123456777', '7c4a8d09ca3762af61e59520943dc26494f8941b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `playfields`
--
ALTER TABLE `playfields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requested_playfield`
--
ALTER TABLE `requested_playfield`
  ADD PRIMARY KEY (`requested_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playfields`
--
ALTER TABLE `playfields`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requested_playfield`
--
ALTER TABLE `requested_playfield`
  MODIFY `requested_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
