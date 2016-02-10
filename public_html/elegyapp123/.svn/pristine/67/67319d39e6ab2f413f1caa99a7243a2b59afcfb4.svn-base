-- phpMyAdmin SQL Dump
-- version 4.4.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2015 at 03:48 AM
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
(6, 'reading', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventId` int(11) NOT NULL,
  `eventTypeId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locationName` varchar(50) NOT NULL,
  `funeralId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `latitude` decimal(12,8) NOT NULL,
  `longitude` decimal(12,8) NOT NULL
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
-- Table structure for table `funeral`
--

CREATE TABLE IF NOT EXISTS `funeral` (
  `funeralId` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `dateOfDeath` date NOT NULL,
  `hostId` int(11) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `profileImage` varchar(255) NOT NULL,
  `serviceTypeId` int(11) DEFAULT NULL,
  `invitationCode` varchar(100) NOT NULL,
  `about` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `funeral`
--

INSERT INTO `funeral` (`funeralId`, `name`, `dateOfBirth`, `dateOfDeath`, `hostId`, `createdTime`, `profileImage`, `serviceTypeId`, `invitationCode`, `about`) VALUES
(1, 'Gina Jones', '1960-10-01', '2015-09-01', 2, '2015-10-27 11:57:00', 'profile_image/default.png', NULL, 'abc1234', 'sdfk slkjfs lksjd speo slksdjf ssdnd poiw lkdj s kldjs slso wpps dlslo slkdhw ls dlks soej rirls dlslowp lsldow sldkhsd sslpw llls wpwpod slsoe spwpk'),
(2, 'John Doe', '1961-10-01', '2015-10-11', 3, '2015-10-27 11:57:00', 'profile_image/default.png', NULL, 'abc1234', 'sdfk slkjfs lksjd speo slksdjf ssdnd poiw lkdj s kldjs slso wpps dlslo slkdhw ls dlks soej rirls dlslowp lsldow sldkhsd sslpw llls wpwpod slsoe spwpk');

-- --------------------------------------------------------

--
-- Table structure for table `funeral_attribute`
--

CREATE TABLE IF NOT EXISTS `funeral_attribute` (
  `id` int(11) NOT NULL,
  `funeralId` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `attributeTypeId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `funeral_attribute`
--

INSERT INTO `funeral_attribute` (`id`, `funeralId`, `value`, `attributeTypeId`) VALUES
(1, 1, 'info@tanzaniteinfotech.com', 1),
(2, 1, 'manoj+3@tanzaniteinfotech.com', 1),
(3, 1, 'manoj@tanzaniteinfotech.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `funeral_guests`
--

CREATE TABLE IF NOT EXISTS `funeral_guests` (
  `id` int(11) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `funeralId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `funeral_guests`
--

INSERT INTO `funeral_guests` (`id`, `emailId`, `funeralId`) VALUES
(1, 'manoj@tanzaniteinfotech.com', 1),
(2, 'patidarmanoj@gmail.com', 1),
(3, 'ashish.bhatt1@tanzaniteinfotech.com', 2),
(4, 'patidarmanoj@gmail.com', 2),
(5, 'manoj+4@tanzaniteinfotech.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) NOT NULL,
  `funeralId` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `isVideo` tinyint(4) NOT NULL DEFAULT '0'
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
  `funeralId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

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
  `roleId` int(11) NOT NULL DEFAULT '1',
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
  `resetPasswordTokenTime` timestamp NULL DEFAULT NULL,
  `accountActivationCode` varchar(100) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `roleId`, `firstName`, `lastName`, `emailId`, `password`, `isActive`, `userToken`, `facebookId`, `profileImage`, `createdTime`, `lastLoginTime`, `resetPasswordToken`, `resetPasswordTokenTime`, `accountActivationCode`, `deleted`) VALUES
(1, 2, NULL, NULL, 'patidarmanoj@gmail.com', NULL, 1, 'usesdlsdfWRSs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 1, 'manoj', 'patidar', 'ashish.bhatt1@tanzaniteinfotech.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 'x7MDwMoqb5ZV', NULL, 'profile_image/default.png', '2015-10-24 17:03:39', NULL, NULL, NULL, NULL, 0),
(3, 1, 'manoj', 'patidar', 'manoj@tanzaniteinfotech.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'RqMxBajfht1B', NULL, 'profile_image/default.png', '2015-10-24 17:04:31', '2015-10-27 22:09:56', NULL, NULL, NULL, 0),
(4, 1, 'manoj', 'patidar', 'manoj 1@tanzaniteinfotech.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'QXN5JfaC3OLd', NULL, 'profile_image/default.png', '2015-10-24 17:08:16', '2015-10-24 13:46:17', NULL, NULL, 'mHsH6ZDo', 0),
(5, 1, 'manoj', 'patidar', 'manoj 2@tanzaniteinfotech.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 't8VnLyjDRfiE', NULL, 'profile_image/default.png', '2015-10-24 19:00:50', '2015-10-24 13:46:06', NULL, NULL, 'Fhqea6D7', 0),
(6, 1, 'manoj', 'patidar', 'manoj 3@tanzaniteinfotech.com', '1bbd886460827015e5d605ed44252251', 1, 't1pm38U0zdDW', NULL, 'profile_image/default.png', '2015-10-24 19:24:49', '2015-10-25 01:28:51', '', '2015-10-25 01:52:30', 'b4s9qMR6', 0),
(7, 1, 'manoj', 'patidar', 'manoj 4@tanzaniteinfotech.com', '25d55ad283aa400af464c76d713c07ad', 1, 'a4qnYg57oXZE', NULL, 'profile_image/default.png', '2015-10-25 06:40:42', '2015-10-26 05:09:29', '', '2015-10-25 01:57:54', 'tnHXvbB5', 0),
(8, 1, 'manoj', 'patidar', 'manoj 9@tanzaniteinfotech.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'cnKjKJDZlWw9', NULL, 'profile_image/default.png', '2015-10-28 03:35:20', '2015-10-27 22:06:08', NULL, NULL, 'quFyGfmQ', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributestype`
--
ALTER TABLE `attributestype`
  ADD PRIMARY KEY (`attributeTypeId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `eventTypeId` (`eventTypeId`),
  ADD KEY `deceasedId` (`funeralId`);

--
-- Indexes for table `eventtype`
--
ALTER TABLE `eventtype`
  ADD PRIMARY KEY (`eventTypeId`);

--
-- Indexes for table `funeral`
--
ALTER TABLE `funeral`
  ADD PRIMARY KEY (`funeralId`),
  ADD KEY `createdBy` (`hostId`),
  ADD KEY `serviceTypeId` (`serviceTypeId`);

--
-- Indexes for table `funeral_attribute`
--
ALTER TABLE `funeral_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deceasedId` (`funeralId`,`attributeTypeId`),
  ADD KEY `attributeTypeId` (`attributeTypeId`);

--
-- Indexes for table `funeral_guests`
--
ALTER TABLE `funeral_guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funeralId` (`funeralId`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdBy` (`createdBy`,`funeralId`),
  ADD KEY `deceasedId` (`funeralId`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdBy` (`createdBy`,`funeralId`),
  ADD KEY `deceasedId` (`funeralId`);

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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `funeral`
--
ALTER TABLE `funeral`
  MODIFY `funeralId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `funeral_attribute`
--
ALTER TABLE `funeral_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `funeral_guests`
--
ALTER TABLE `funeral_guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`eventTypeId`) REFERENCES `eventtype` (`eventTypeId`);

--
-- Constraints for table `funeral`
--
ALTER TABLE `funeral`
  ADD CONSTRAINT `funeral_ibfk_1` FOREIGN KEY (`hostId`) REFERENCES `users` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `funeral_ibfk_2` FOREIGN KEY (`serviceTypeId`) REFERENCES `servicetype` (`serviceTypeId`) ON UPDATE CASCADE;

--
-- Constraints for table `funeral_attribute`
--
ALTER TABLE `funeral_attribute`
  ADD CONSTRAINT `funeral_attribute_ibfk_1` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `funeral_attribute_ibfk_2` FOREIGN KEY (`attributeTypeId`) REFERENCES `attributestype` (`attributeTypeId`) ON UPDATE CASCADE;

--
-- Constraints for table `funeral_guests`
--
ALTER TABLE `funeral_guests`
  ADD CONSTRAINT `funeral_guests_ibfk_1` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`) ON UPDATE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_ibfk_2` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`);

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_ibfk_2` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
