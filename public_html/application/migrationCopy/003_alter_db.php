<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_db extends CI_Migration {

	public function up()
	{
		$sql ="ALTER TABLE `users` ADD UNIQUE( `facebookId`);";
		$this->db->query($sql);
	
	}

	public function down()
	{
		$sql ="ALTER TABLE users DROP INDEX facebookId;";
		$this->db->query($sql);
	
	}

}