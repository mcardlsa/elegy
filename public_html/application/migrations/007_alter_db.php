<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_db extends CI_Migration {

	public function up()
	{
			$sql="CREATE TABLE IF NOT EXISTS `user_devices` (
			  `udId` int(11) NOT NULL AUTO_INCREMENT,
			  `userId` int(11) NOT NULL,
			  `deviceType` varchar(10) NOT NULL,
			  `deviceToken` varchar(255) NOT NULL,
			  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  
			  PRIMARY KEY (udId),
			  FOREIGN KEY (userId) REFERENCES users(userId) ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$this->db->query($sql);
	 }
	public function down()
	{
		$this->dbforge->drop_table('user_devices');
	}
}