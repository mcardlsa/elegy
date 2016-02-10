-- phpMyAdmin SQL Dump
-- version 4.4.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 24, 2015 at 02:46 PM
-- Server version: 5.6.23
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elegy`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributestype`
--

CREATE TABLE IF NOT EXISTS `attributestype` (
  `attributeTypeId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `required` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributestype`
--

INSERT INTO `attributestype` (`attributeTypeId`, `name`, `required`) VALUES
(1, 'familyMember', 0),
(2, 'pallbearer', 0),
(3, 'officient', 0),
(4, 'eulogy', 0),
(5, 'song', 0),
(6, 'reading', 0),
(7, 'guest', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deceased`
--

CREATE TABLE IF NOT EXISTS `deceased` (
  `deceasedId` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `dateOfDeath` date NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `profileImage` varchar(255) NOT NULL,
  `serviceTypeId` int(11) NOT NULL,
  `invitationCode` varchar(100) NOT NULL,
  `about` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deceased_attribute`
--

CREATE TABLE IF NOT EXISTS `deceased_attribute` (
  `id` int(11) NOT NULL,
  `deceasedId` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `attributeTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventId` int(11) NOT NULL,
  `eventTypeId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locationName` varchar(50) NOT NULL,
  `deceasedId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventtype`
--

CREATE TABLE IF NOT EXISTS `eventtype` (
  `eventTypeId` int(11) NOT NULL,
  `eventType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventtype`
--

INSERT INTO `eventtype` (`eventTypeId`, `eventType`) VALUES
(1, 'wake'),
(2, 'ceremony'),
(3, 'burial'),
(4, 'reception');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) NOT NULL,
  `deceasedId` int(11) NOT NULL,
  `title` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE IF NOT EXISTS `journal` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deceasedId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`) VALUES
(1, 'owner'),
(2, 'guest');

-- --------------------------------------------------------

--
-- Table structure for table `servicetype`
--

CREATE TABLE IF NOT EXISTS `servicetype` (
  `serviceTypeId` int(11) NOT NULL,
  `serviceType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `emailId` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '0',
  `userToken` varchar(20) NOT NULL,
  `facebookId` varchar(255) DEFAULT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `createdTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastLoginTime` timestamp NULL DEFAULT NULL,
  `resetPasswordToken` varchar(100) DEFAULT NULL,
  `resetPasswordExpire` timestamp NULL DEFAULT NULL,
  `activationCode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `roleId`, `firstName`, `lastName`, `emailId`, `password`, `isActive`, `userToken`, `facebookId`, `profileImage`, `createdTime`, `lastLoginTime`, `resetPasswordToken`, `resetPasswordExpire`, `activationCode`) VALUES
(1, 2, NULL, NULL, 'patidarmanoj@gmail.com', NULL, 1, 'usesdlsdfWRSs', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributestype`
--
ALTER TABLE `attributestype`
  ADD PRIMARY KEY (`attributeTypeId`);

--
-- Indexes for table `deceased`
--
ALTER TABLE `deceased`
  ADD PRIMARY KEY (`deceasedId`),
  ADD KEY `createdBy` (`createdBy`),
  ADD KEY `serviceTypeId` (`serviceTypeId`);

--
-- Indexes for table `deceased_attribute`
--
ALTER TABLE `deceased_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deceasedId` (`deceasedId`,`attributeTypeId`),
  ADD KEY `attributeTypeId` (`attributeTypeId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `eventTypeId` (`eventTypeId`),
  ADD KEY `deceasedId` (`deceasedId`);

--
-- Indexes for table `eventtype`
--
ALTER TABLE `eventtype`
  ADD PRIMARY KEY (`eventTypeId`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdBy` (`createdBy`,`deceasedId`),
  ADD KEY `deceasedId` (`deceasedId`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdBy` (`createdBy`,`deceasedId`),
  ADD KEY `deceasedId` (`deceasedId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `servicetype`
--
ALTER TABLE `servicetype`
  ADD PRIMARY KEY (`serviceTypeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `roleId` (`roleId`),
  ADD KEY `roleId_2` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributestype`
--
ALTER TABLE `attributestype`
  MODIFY `attributeTypeId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `deceased`
--
ALTER TABLE `deceased`
  MODIFY `deceasedId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deceased_attribute`
--
ALTER TABLE `deceased_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `servicetype`
--
ALTER TABLE `servicetype`
  MODIFY `serviceTypeId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `deceased`
--
ALTER TABLE `deceased`
  ADD CONSTRAINT `deceased_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `deceased_ibfk_2` FOREIGN KEY (`serviceTypeId`) REFERENCES `eventtype` (`eventTypeId`) ON UPDATE CASCADE;

--
-- Constraints for table `deceased_attribute`
--
ALTER TABLE `deceased_attribute`
  ADD CONSTRAINT `deceased_attribute_ibfk_1` FOREIGN KEY (`deceasedId`) REFERENCES `deceased` (`deceasedId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `deceased_attribute_ibfk_2` FOREIGN KEY (`attributeTypeId`) REFERENCES `attributestype` (`attributeTypeId`) ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`deceasedId`) REFERENCES `deceased` (`deceasedId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`eventTypeId`) REFERENCES `eventtype` (`eventTypeId`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_ibfk_2` FOREIGN KEY (`deceasedId`) REFERENCES `deceased` (`deceasedId`);

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_ibfk_2` FOREIGN KEY (`deceasedId`) REFERENCES `deceased` (`deceasedId`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
