-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2021 at 12:51 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectswec`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `UserName`, `Password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin2', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `internalbookinginvoice`
--

CREATE TABLE `internalbookinginvoice` (
  `BookingNo` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `RoomNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `internalbookinginvoice`
--

INSERT INTO `internalbookinginvoice` (`BookingNo`, `UserID`, `RoomNo`) VALUES
(17, 7, 1),
(18, 7, 5),
(27, 7, 1),
(28, 7, 2),
(29, 7, 1),
(30, 7, 1),
(31, 7, 5),
(32, 11, 4),
(33, 11, 5),
(34, 11, 1),
(35, 10, 15),
(36, 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `internaluser`
--

CREATE TABLE `internaluser` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ContactNo` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `internaluser`
--

INSERT INTO `internaluser` (`UserID`, `UserName`, `UserEmail`, `Password`, `ContactNo`) VALUES
(7, 'Ho Wan Yu', 'hehe@gmail.com', 'aaAA1!', 144444444),
(10, 'chris', 'chris96055@gmail.com', '11!qqQ', 60199999999),
(11, 'song', 'song@gmail.com', '11!qqQ', 111111111),
(12, 'zhenye', 'zhenye@gmail.com', '11!qqQ', 60122222222),
(13, 'ali', 'ali@gmail.com', 'qqQ11!', 198883333),
(14, 'abu', 'abu@gmail.com', 'uuU88*', 198886666);

-- --------------------------------------------------------

--
-- Table structure for table `paymentinvoice`
--

CREATE TABLE `paymentinvoice` (
  `PaymentID` int(11) NOT NULL,
  `PaymentMethod` enum('Credit','PayPal') NOT NULL,
  `PaidPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentinvoice`
--

INSERT INTO `paymentinvoice` (`PaymentID`, `PaymentMethod`, `PaidPrice`) VALUES
(29, 'Credit', 40),
(30, 'Credit', 40),
(31, 'Credit', 40),
(32, 'Credit', 40),
(33, 'Credit', 40),
(34, 'Credit', 40),
(35, 'Credit', 100),
(36, 'PayPal', 30),
(37, 'PayPal', 30),
(38, 'PayPal', 30),
(39, 'PayPal', 30),
(40, 'Credit', 100),
(41, 'Credit', 100),
(42, 'PayPal', 200),
(43, 'PayPal', 60),
(44, 'Credit', 600),
(45, 'Credit', 400),
(46, 'Credit', 100);

-- --------------------------------------------------------

--
-- Table structure for table `publicbookinginvoice`
--

CREATE TABLE `publicbookinginvoice` (
  `BookingNo` int(11) NOT NULL,
  `GuestID` int(11) NOT NULL,
  `RoomNo` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publicbookinginvoice`
--

INSERT INTO `publicbookinginvoice` (`BookingNo`, `GuestID`, `RoomNo`, `PaymentID`) VALUES
(16, 13, 9, 41),
(17, 13, 11, 42),
(18, 20, 3, 43),
(19, 13, 13, 44),
(20, 13, 12, 45),
(21, 21, 9, 46);

-- --------------------------------------------------------

--
-- Table structure for table `publicuser`
--

CREATE TABLE `publicuser` (
  `GuestID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ContactNo` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publicuser`
--

INSERT INTO `publicuser` (`GuestID`, `UserName`, `UserEmail`, `Password`, `ContactNo`) VALUES
(13, 'Chris', 'chris@gmail.com', 'aaAA1!', 60196386769),
(16, 'Wanyu', 'wanyu@gmail.com', 'aaAA1!', 60161112222),
(17, 'Song', 'song123@gmail.com', '11!qqQ', 60142223333),
(18, 'zhenye1', 'zhenye@gmail.com', 'qqQ11!', 60122222222),
(20, 'dwyane', 'wade@gmail.com', '11!qqQ', 60133333333),
(21, 'Christopher', 'chris96055@gmail.com', '11!qqQ', 196386769);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomNo` int(11) NOT NULL,
  `RoomName` varchar(255) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Capacity` int(10) NOT NULL,
  `Price` float NOT NULL,
  `Availability` enum('available','unavailable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomNo`, `RoomName`, `AdminID`, `Date`, `Time`, `Capacity`, `Price`, `Availability`) VALUES
(1, '	Meeting room 1', 1, '2021-06-30', '08:00:00', 10, 20, 'available'),
(2, 'Meeting room 2', 2, '2021-06-16', '10:00:00', 10, 20, 'available'),
(3, 'Meeting room 3', 2, '2021-06-17', '12:30:00', 10, 20, 'available'),
(4, 'Meeting room 4', 2, '2021-06-17', '14:00:00', 10, 20, 'available'),
(5, 'Meeting room 5', 2, '2021-06-18', '09:00:00', 10, 20, 'available'),
(9, 'VIP Meeting Room 1', 1, '2021-06-18', '12:04:00', 20, 50, 'available'),
(10, 'VIP Meeting Room 2', 1, '2021-06-19', '08:50:00', 20, 50, 'available'),
(11, 'VIP Meeting Room 3', 1, '2021-06-21', '05:00:00', 20, 50, 'available'),
(12, 'VIP Meeting Room 4', 1, '2021-06-18', '22:00:00', 20, 50, 'available'),
(13, 'VIP Meeting Room 5', 1, '2021-06-26', '14:00:00', 30, 50, 'available'),
(15, 'VIP Meeting Room 6', 1, '2021-06-19', '20:30:00', 20, 50, 'available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `internalbookinginvoice`
--
ALTER TABLE `internalbookinginvoice`
  ADD PRIMARY KEY (`BookingNo`),
  ADD KEY `booki` (`UserID`),
  ADD KEY `roomi` (`RoomNo`);

--
-- Indexes for table `internaluser`
--
ALTER TABLE `internaluser`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `paymentinvoice`
--
ALTER TABLE `paymentinvoice`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `publicbookinginvoice`
--
ALTER TABLE `publicbookinginvoice`
  ADD PRIMARY KEY (`BookingNo`),
  ADD KEY `guest` (`GuestID`),
  ADD KEY `room` (`RoomNo`),
  ADD KEY `guestpayment` (`PaymentID`);

--
-- Indexes for table `publicuser`
--
ALTER TABLE `publicuser`
  ADD PRIMARY KEY (`GuestID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomNo`),
  ADD KEY `admin` (`AdminID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `internalbookinginvoice`
--
ALTER TABLE `internalbookinginvoice`
  MODIFY `BookingNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `internaluser`
--
ALTER TABLE `internaluser`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `paymentinvoice`
--
ALTER TABLE `paymentinvoice`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `publicbookinginvoice`
--
ALTER TABLE `publicbookinginvoice`
  MODIFY `BookingNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `publicuser`
--
ALTER TABLE `publicuser`
  MODIFY `GuestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `RoomNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `internalbookinginvoice`
--
ALTER TABLE `internalbookinginvoice`
  ADD CONSTRAINT `booki` FOREIGN KEY (`UserID`) REFERENCES `internaluser` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roomi` FOREIGN KEY (`RoomNo`) REFERENCES `room` (`RoomNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publicbookinginvoice`
--
ALTER TABLE `publicbookinginvoice`
  ADD CONSTRAINT `guest` FOREIGN KEY (`GuestID`) REFERENCES `publicuser` (`GuestID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guestpayment` FOREIGN KEY (`PaymentID`) REFERENCES `paymentinvoice` (`PaymentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room` FOREIGN KEY (`RoomNo`) REFERENCES `room` (`RoomNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `admin` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
