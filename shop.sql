-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2017 at 06:00 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Parent` int(11) NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT '0',
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT '0',
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Parent`, `Ordering`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(6, 'Hand Made', 'Hand Made Items', 0, 1, 0, 0, 0),
(7, 'Computers', 'Computers Items', 0, 2, 0, 0, 0),
(8, 'Cell Phones', 'Cell Phones Item', 0, 3, 0, 0, 0),
(9, 'Clothes', 'Clothes item', 0, 4, 0, 0, 0),
(10, 'Tools', 'Home Tools', 0, 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_id` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Description` text CHARACTER SET utf8 NOT NULL,
  `Price` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Date` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `Cat_ID` int(11) NOT NULL,
  `Members_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_id`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Date`, `Image`, `Status`, `Rating`, `Cat_ID`, `Members_ID`) VALUES
(4, 'Magic Mouse', 'apple magic mouse', '150$', '2017-01-11', 'china', '', '1', 0, 7, 1),
(6, 'mafi title', 'mafi a7la mena ', '123', '2017-01-14', 'china', '', '1', 0, 7, 1),
(7, 'calculater', 'fx-991ES plus gold calculater', '30', '2017-01-15', 'china', '', '3', 0, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'To identify user',
  `Username` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Username Login',
  `Password` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Password Login',
  `Email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `FullName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `GroupId` int(11) NOT NULL DEFAULT '0' COMMENT 'Identify User Group',
  `TrustStates` int(11) NOT NULL DEFAULT '0' COMMENT 'Seller Rank',
  `RegState` int(11) NOT NULL DEFAULT '0' COMMENT 'User Approval',
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupId`, `TrustStates`, `RegState`, `Date`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin@blah.blah', 'new admin', 1, 0, 0, '2017-01-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_id`),
  ADD KEY `member_1` (`Members_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To identify user', AUTO_INCREMENT=74;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Members_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
