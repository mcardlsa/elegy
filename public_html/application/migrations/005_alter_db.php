<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_db extends CI_Migration {

	public function up()
	{
		$sql ="INSERT INTO `servicetype` (`serviceTypeId`, `serviceType`) VALUES (NULL, 'Traditional'), (NULL, 'Graveside'), (NULL, 'Immediate Burial')";
		$this->db->query($sql);
	
	}

	public function down()
	{
		$sql ="DELETE FROM `servicetype` where `serviceType` = ('Traditional' OR 'Graveside' OR 'Immediate Burial');";
		$this->db->query($sql);
	
	}

}