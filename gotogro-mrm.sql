-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2023 at 10:28 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gotogro-mrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL,
  `MemberFirstName` varchar(50) NOT NULL,
  `MemberLastName` varchar(40) NOT NULL,
  `MemberDateOfBirth` date DEFAULT NULL,
  `MemberEmail` varchar(40) NOT NULL,
  `MemberPhone` varchar(20) NOT NULL,
  `MemberAddress` varchar(100) NOT NULL,
  `MemberSuburb` varchar(30) NOT NULL,
  `MemberState` varchar(30) NOT NULL,
  `MemberPostcode` int(4) NOT NULL,
  `MemberJoinDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `MemberFirstName`, `MemberLastName`, `MemberDateOfBirth`, `MemberEmail`, `MemberPhone`, `MemberAddress`, `MemberSuburb`, `MemberState`, `MemberPostcode`, `MemberJoinDate`) VALUES
(1, 'John', 'Larkin', '2001-07-11', 'jlarkin@gmail.com', '0451234567', '9 ABC Street', 'Longwood', 'VIC', 4111, '2023-09-16'),
(2, 'Elizabeth', 'McLachlan', '1987-11-12', 'emclachlan@gmail.com', '0450111222', '12 Morrow Road', 'Longwood', 'NSW', 4444, '2023-09-17'),
(3, 'Arnold', 'McLachlan', '1985-06-18', 'arnmcclachlan@gmail.com', '0450333444', '12 Morrow Road', 'Longwood', 'NSW', 4444, '2023-09-18'),
(5, 'John', 'Doe', '2023-09-01', 'jdoe@idk.com', '045011122233', '123', '123', 'VIC', 1233, '2023-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(3) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductStock` int(4) NOT NULL,
  `ProductSupplyDate` date NOT NULL,
  `ProductSupplier` varchar(50) NOT NULL,
  `ProductPricePerUnit` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `ProductStock`, `ProductSupplyDate`, `ProductSupplier`, `ProductPricePerUnit`) VALUES
(1, 'Golden Apples', 500, '2023-09-06', 'The Appler', 5.00),
(2, 'Bergerson Sour Cream Chips', 200, '2023-09-02', 'Bergerson Snacks', 14.00),
(3, 'Rainbow Drops', 400, '2023-08-31', 'Bergerson Snacks', 8.00),
(5, 'Markson Instant Noodles', 350, '2023-09-14', 'Markson QuickGoods', 3.50),
(6, 'Marks Bananas', 1000, '2023-09-07', 'Mark', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SalesID` int(11) NOT NULL,
  `SalesSoldDate` date NOT NULL,
  `SalesItem` varchar(50) NOT NULL,
  `SalesBuyerName` varchar(100) NOT NULL,
  `SalesQuantity` int(10) NOT NULL,
  `SalesPrice` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SalesID`, `SalesSoldDate`, `SalesItem`, `SalesBuyerName`, `SalesQuantity`, `SalesPrice`) VALUES
(1, '2023-09-15', 'Rainbow Drops', 'John Larkin', 3, 24.00),
(2, '2023-09-09', 'Golden Apples', 'Elizabeth McLachlan', 4, 20.00),
(3, '2023-09-08', 'Rainbow Drops', 'John Larkin', 6, 48.00),
(4, '2023-09-12', 'Bergerson Sour Cream Chips', 'John Doe', 5, 70.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `StaffName` varchar(50) NOT NULL,
  `StaffEmail` varchar(40) NOT NULL,
  `StaffPassword` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SalesID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SalesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
