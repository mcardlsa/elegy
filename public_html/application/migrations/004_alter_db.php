<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_db extends CI_Migration {

	public function up()
	{
		$sql ="ALTER TABLE `servicetype` ADD UNIQUE( `serviceType`);";
		$this->db->query($sql);
	
	}

	public function down()
	{
		$sql ="ALTER TABLE `servicetype` DROP INDEX `serviceType`;";
		$this->db->query($sql);
	
	}

}