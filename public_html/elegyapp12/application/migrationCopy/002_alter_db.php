<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_db extends CI_Migration {

	public function up()
	{
		$gallery_fields = array(
			'uri_thumb' => array('type' => 'VARCHAR(255)','null' => TRUE)
		);
		$this->dbforge->modify_column('gallery', $gallery_fields);
		
	
	}

	public function down()
	{
		$gallery_fields = array(
			'uri_thumb' => array('type' => 'VARCHAR(255)','null' => FALSE)
		);
		$this->dbforge->modify_column('gallery', $gallery_fields);
		
	
	}

}