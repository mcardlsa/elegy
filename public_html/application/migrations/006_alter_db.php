<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_db extends CI_Migration {

	public function up()
	{
			$sql="CREATE TABLE IF NOT EXISTS `feed` (
			  `feedId` int(11) NOT NULL AUTO_INCREMENT,
			  `text` varchar(100) NOT NULL,
			  `thumb_URL` varchar(255) NOT NULL,
			  `media_URL` varchar(255) NOT NULL,
			  `mediaType` varchar(100) NOT NULL,
			  `createdBy` int(11) NOT NULL,
			  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `funeralId` int(11) NOT NULL,
			  PRIMARY KEY (feedId)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$this->db->query($sql);
		      
		    
			$sql ="ALTER TABLE `feed`
		  	ADD CONSTRAINT `feed_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userId`) ON UPDATE CASCADE,
		  	ADD CONSTRAINT `feed_ibfk_2` FOREIGN KEY (`funeralId`) REFERENCES `funeral` (`funeralId`) ON UPDATE CASCADE;";
			$this->db->query($sql);
  

  
  }
	public function down()
	{
		$this->dbforge->drop_table('feed');
	}
}