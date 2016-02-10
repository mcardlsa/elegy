<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_db extends CI_Migration {

	public function up()
	{
		
		$sql ="CREATE TABLE IF NOT EXISTS `attributestype` (
  			`attributeTypeId` int(11) NOT NULL,
  			`name` varchar(100) NOT NULL,
  			`required` int(11) NOT NULL DEFAULT '0'
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		$this->db->query($sql);
		
		
		$sql = "CREATE TABLE IF NOT EXISTS `events` (
  `eventId` int(11) NOT NULL,
  `eventTypeId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locationName` varchar(50) NOT NULL,
  `funeralId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `latitude` decimal(12,8) NOT NULL,
  `longitude` decimal(12,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$this->db->query($sql);
	
	$sql ="CREATE TABLE IF NOT EXISTS `eventtype` (
  `eventTypeId` int(11) NOT NULL,
  `eventType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$this->db->query($sql);

		
	$sql="CREATE TABLE IF NOT EXISTS `funeral` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$this->db->query($sql);


$sql ="CREATE TABLE IF NOT EXISTS `funeral_attribute` (
  `id` int(11) NOT NULL,
  `funeralId` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `attributeTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$this->db->query($sql);


$sql ="CREATE TABLE IF NOT EXISTS `funeral_guests` (
  `id` int(11) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `funeralId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$this->db->query($sql);

$sql="CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) NOT NULL,
  `funeralId` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `isVideo` tinyint(4) NOT NULL DEFAULT '0',
  `uri_thumb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$this->db->query($sql);

$sql="CREATE TABLE IF NOT EXISTS `journal` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `funeralId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$this->db->query($sql);




$sql ="CREATE TABLE IF NOT EXISTS `roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$this->db->query($sql);


$sql ="CREATE TABLE IF NOT EXISTS `servicetype` (
  `serviceTypeId` int(11) NOT NULL,
  `serviceType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$this->db->query($sql);


$sql ="CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$this->db->query($sql);

$sql ="ALTER TABLE `attributestype`
  ADD PRIMARY KEY (`attributeTypeId`);";
  $this->db->query($sql);
  
  
 $sql ="ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `eventTypeId` (`eventTypeId`),
  ADD KEY `deceasedId` (`funeralId`);";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `eventtype`
  ADD PRIMARY KEY (`eventTypeId`);";
  $this->db->query($sql);
  
  
  $sql ="ALTER TABLE `funeral`
  ADD PRIMARY KEY (`funeralId`),
  ADD UNIQUE KEY `invitationCode` (`invitationCode`),
  ADD KEY `createdBy` (`hostId`),
  ADD KEY `serviceTypeId` (`serviceTypeId`);";
  $this->db->query($sql);
  
  
  $sql ="ALTER TABLE `funeral_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deceasedId` (`funeralId`,`attributeTypeId`),
  ADD KEY `attributeTypeId` (`attributeTypeId`);";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `funeral_guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funeralId` (`funeralId`);";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdBy` (`createdBy`,`funeralId`),
  ADD KEY `deceasedId` (`funeralId`);";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdBy` (`createdBy`,`funeralId`),
  ADD KEY `deceasedId` (`funeralId`);";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `servicetype`
  ADD PRIMARY KEY (`serviceTypeId`);";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `roleId` (`roleId`),
  ADD KEY `roleId_2` (`roleId`);";
  $this->db->query($sql);
  
  
  $sql ="ALTER TABLE `attributestype`
  MODIFY `attributeTypeId` int(11) NOT NULL AUTO_INCREMENT;";
  $this->db->query($sql);
  
  
  $sql ="ALTER TABLE `events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT;";
  $this->db->query($sql);
  
  
  $sql ="ALTER TABLE `funeral`
  MODIFY `funeralId` int(11) NOT NULL AUTO_INCREMENT;";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `funeral_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `funeral_guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT;";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `servicetype`
  MODIFY `serviceTypeId` int(11) NOT NULL AUTO_INCREMENT;";
  $this->db->query($sql);
  
  $sql ="ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;";
  $this->db->query($sql);
   
	
$sql ="ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`eventTypeId`) REFERENCES `eventtype` (`eventTypeId`);";
$this->db->query($sql);

$sql ="ALTER TABLE `funeral`
  ADD CONSTRAINT `funeral_ibfk_1` FOREIGN KEY (`hostId`) REFERENCES `users` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `funeral_ibfk_2` FOREIGN KEY (`serviceTypeId`) REFERENCES `servicetype` (`serviceTypeId`) ON UPDATE CASCADE;";
$this->db->query($sql);

$sql ="ALTER TABLE `funeral_attribute`
  ADD CONSTRAINT `funeral_attribute_ibfk_1` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `funeral_attribute_ibfk_2` FOREIGN KEY (`attributeTypeId`) REFERENCES `attributestype` (`attributeTypeId`) ON UPDATE CASCADE;";
$this->db->query($sql);

$sql ="ALTER TABLE `funeral_guests`
  ADD CONSTRAINT `funeral_guests_ibfk_1` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`) ON UPDATE CASCADE;";
$this->db->query($sql);

$sql ="ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_ibfk_2` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`);";
$this->db->query($sql);

$sql ="ALTER TABLE `journal`
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_ibfk_2` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`) ON UPDATE CASCADE;";
$this->db->query($sql);

$sql ="ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`) ON UPDATE CASCADE;";
	$this->db->query($sql);
	
		
	}

	public function down()
	{
		
	
		$this->dbforge->drop_table('attributestype');
		$this->dbforge->drop_table('events');
		$this->dbforge->drop_table('eventtype');
		$this->dbforge->drop_table('funeral');
		$this->dbforge->drop_table('funeral_attribute');
		$this->dbforge->drop_table('funeral_guests');
		$this->dbforge->drop_table('gallery');
		$this->dbforge->drop_table('journal');
		$this->dbforge->drop_table('roles');
		$this->dbforge->drop_table('servicetype');
		$this->dbforge->drop_table('users');
		
	}

}