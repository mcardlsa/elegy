<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_db extends CI_Migration {

public function up()
	{
		$funeral_fields = array(
			'about' => array('name' => 'about', 'type' => 'varchar', 'constraint' => '35000' )
		);
	    $event_fields = array(
			'locationName' => array('name' => 'locationName', 'type' => 'varchar', 'constraint' => '255' )
		);
		$this->dbforge->modify_column('funeral',$funeral_fields);
	    $this->dbforge->modify_column('events',$event_fields);
		
	}	
	
public function down()
	{	
	  $funeral_fields = array(
			'about' => array('name' => 'about', 'type' => 'varchar', 'constraint' => '255')
		);
		$this->dbforge->modify_column('funeral', $funeral_fields);
	  
	  $event_fields = array(
			'locationName' => array('name' => 'locationName', 'type' => 'varchar', 'constraint' => '50')
		);
		$this->dbforge->modify_column('events', $event_fields);
	}
}