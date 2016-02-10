<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_db extends CI_Migration {

	public function up()
	{
			$sql="CREATE TABLE IF NOT EXISTS `user_settings` (
			  `userSettingId` int(11) NOT NULL AUTO_INCREMENT,
			  `userId` int(11) NOT NULL,
			  `isMemoryNotification` tinyint NOT NULL,
			  `isScheduleNotification` tinyint NOT NULL,
			  `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  
			  PRIMARY KEY (userSettingId),
			  FOREIGN KEY (userId) REFERENCES users(userId) ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$this->db->query($sql);
	 }
	public function down()
	{
		$this->dbforge->drop_table('user_settings');
	}
}