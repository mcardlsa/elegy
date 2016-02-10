<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_db extends CI_Migration {

	public function up()
	{
			$sql="CREATE TABLE IF NOT EXISTS `anonymous_user_device_token` (
			  	`id` int(11) NOT NULL AUTO_INCREMENT,
			  `funeralId` int(11) NOT NULL,
			  `deviceToken` varchar(255) NOT NULL,
			 `createdTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  
			  PRIMARY KEY (id),
			  FOREIGN KEY (funeralId) REFERENCES funeral(funeralId) ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$this->db->query($sql);
	 }
	public function down()
	{
		$this->dbforge->drop_table('anonymous_user_device_token');
	}
}