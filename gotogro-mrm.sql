-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 11:23 AM
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
  `MemberLastName` varchar(50) NOT NULL,
  `MemberDateOfBirth` date DEFAULT NULL,
  `MemberEmail` varchar(40) NOT NULL,
  `MemberPhone` varchar(10) NOT NULL,
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
(1, 'Jonathan', 'Lurker', '2023-10-13', 'jonlurker1111@gmail.com', '0223334444', '14443 Walker Street', 'Johnwood', 'VIC', 3122, '2023-10-13'),
(2, 'Henry', 'MacPherson', '0000-00-00', 'henmac@gmail.com', '0444323123', '24 Archer Street', 'Arrowhood', 'NSW', 4111, '2023-10-13'),
(3, 'Hugh', 'Mann', '2003-06-10', 'definitelyreal@gmail.com', '0333145869', '77A Heartwell Avenue', 'Othersky', 'NSW', 1443, '2023-10-13'),
(4, 'Mark', 'Anderson', '1997-02-13', 'markerson@gmail.com', '0111472983', '11B Antlers Street', 'Matchston', 'QLD', 4321, '2023-10-13');

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
(1, 'FreshFarms Organic Apples', 100, '2023-10-13', 'FreshFarms', 4.00),
(2, 'SunnyMeadow Orange Juice', 300, '2023-10-13', 'SunnyMeadow', 3.00),
(3, 'Greengrove Spinach', 200, '2023-10-10', 'Greengrove', 5.10),
(4, 'Jays Sour Cream Chips', 150, '2023-10-12', 'J and J', 12.00),
(5, 'Hartwell Yellow Bell Peppers', 400, '2023-10-13', 'Hartwell Goods', 2.00);

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
(1, '2023-10-13', 'FreshFarms Organic Apples', 'Jonathan Lurker', 12, 48.00),
(2, '2023-10-13', 'Greengrove Spinach', 'Henry MacPherson', 5, 25.50),
(3, '2023-10-14', 'Greengrove Spinach', 'Mark Anderson', 12, 61.20),
(4, '2023-10-13', 'Hartwell Yellow Bell Peppers', 'Hugh Mann', 5, 10.00),
(5, '2023-10-13', 'FreshFarms Organic Apples', 'Henry MacPherson', 90, 360.00);

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
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SalesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
