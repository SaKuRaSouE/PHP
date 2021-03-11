-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2021 at 05:25 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookID` varchar(5) NOT NULL,
  `BookName` varchar(50) NOT NULL,
  `TypeID` varchar(3) NOT NULL,
  `StatusID` varchar(3) NOT NULL,
  `Publish` varchar(20) DEFAULT NULL,
  `UnitPrice` int(4) DEFAULT NULL,
  `UnitRent` int(2) DEFAULT NULL,
  `DayAmount` int(2) NOT NULL,
  `Picture` mediumblob NOT NULL,
  `BookDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` varchar(4) NOT NULL,
  `CustomerName` varchar(30) NOT NULL,
  `CustomerSurname` varchar(30) NOT NULL,
  `CustomerAddr` varchar(60) DEFAULT NULL,
  `CustomerPhone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `statusbook`
--

CREATE TABLE `statusbook` (
  `StatusID` varchar(2) NOT NULL,
  `StatusName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `typebook`
--

CREATE TABLE `typebook` (
  `TypeID` varchar(3) NOT NULL,
  `TypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `statusbook`
--
ALTER TABLE `statusbook`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indexes for table `typebook`
--
ALTER TABLE `typebook`
  ADD PRIMARY KEY (`TypeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
