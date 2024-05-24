-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 12:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airplaneticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminName` varchar(50) NOT NULL,
  `adminEmail` varchar(50) NOT NULL,
  `adminPass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminName`, `adminEmail`, `adminPass`) VALUES
('admin', 'admin@example.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bId` int(50) NOT NULL,
  `id` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `ticketType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bId`, `id`, `email`, `price`, `ticketType`) VALUES
(22, 61, 'mubasshirsadat25@gmail.com', 5000, 'businessClass'),
(23, 63, 'mubasshirsadat25@gmail.com', 5000, 'economyClass'),
(24, 64, 'testuser@example.com', 100, 'economyClass'),
(25, 64, 'testuser@example.com', 100, 'economyClass'),
(26, 64, 'testuser@example.com', 100, 'economyClass'),
(27, 64, 'testuser@example.com', 100, 'economyClass'),
(28, 64, 'testuser@example.com', 100, 'economyClass');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `id` int(50) NOT NULL,
  `adminName` varchar(50) NOT NULL,
  `departure` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `fTime` varchar(50) NOT NULL,
  `fDate` varchar(50) NOT NULL,
  `totalSeats` int(50) NOT NULL,
  `economySeats` int(50) NOT NULL,
  `businessSeats` int(50) NOT NULL,
  `firstClassSeats` int(50) NOT NULL,
  `pilot` varchar(50) NOT NULL,
  `airHostess1` varchar(50) NOT NULL,
  `airHostess2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`id`, `adminName`, `departure`, `destination`, `fTime`, `fDate`, `totalSeats`, `economySeats`, `businessSeats`, `firstClassSeats`, `pilot`, `airHostess1`, `airHostess2`) VALUES
(61, '', 'Dhaka', 'Real Madrid', '19:28', '2024-05-25', 99, 50, 27, 20, '1', '6', '7'),
(63, '', 'Dhaka', 'London', '19:27', '2024-05-25', 148, 98, 40, 8, '2', '8', '9'),
(64, '', 'Dhaka', 'Noakhali', '19:31', '2024-05-31', 143, 93, 40, 9, '1', '6', '7');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passportNo` int(50) NOT NULL,
  `mobileNo` int(50) NOT NULL,
  `gender` char(1) NOT NULL,
  `age` int(5) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `type`, `name`) VALUES
(1, 'Pilot', 'Md Hussain'),
(2, 'Pilot', 'Md Iqbal'),
(3, 'Pilot', 'Sabrina Akter'),
(4, 'Pilot', 'Anik Mahmud'),
(5, 'Pilot', 'Hasan Ali'),
(6, 'Air Hostess', 'Mehreen Begum'),
(7, 'Air Hostess', 'Rahima Akter'),
(8, 'Air Hostess', 'Mahapara Saha'),
(9, 'Air Hostess', 'Samniya Islam'),
(10, 'Air Hostess', 'Suha Karim'),
(11, 'Air Hostess', 'Muhaimina Islam'),
(12, 'Air Hostess', 'Jannatul Ferdous'),
(13, 'Air Hostess', 'Jannatul Nayem'),
(14, 'Air Hostess', 'Sultana Rajia'),
(15, 'Air Hostess', 'Fatema Akter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminEmail`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bId`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `passportNo` (`passportNo`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bId` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id`) REFERENCES `flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
