<?php 

//if ( PHP_SAPI !== 'cli' ) exit('No web access allowed');


class Migrate extends CI_Controller {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('migration');
		
	}
	
	public function initial()
	{
		if ($this->migration->version(1) === FALSE)
		{
			show_error($this->migration->error_string());
		}else{
			echo "DB script executed successfully\n";
		}
	}
	public function current()
	{	
		if ($this->migration->current() === FALSE)
		{
			show_error($this->migration->error_string());
		}else{
			echo "success\n";
		}
	}

	public function latest()
	{	
		if ($this->migration->latest() === FALSE)
		{
			show_error($this->migration->error_string());
		}else{
			echo "success\n";
		}
	}
	
	public function version($version)
	{	
		if ($this->migration->version($version) === FALSE)
		{
			show_error($this->migration->error_string());
		}else{
			echo "success\n";
		}
	}
	
	
}
