<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/facebook.php';
class Fb extends CI_Controller {
   public function __construct(){
			parent::__construct();
		    $this->load->library('session');   
			$this->config->load('config_facebook');
    }
	public function index()
	{
	    $this->load->view('fb/fb');
	} 
 
	function logout(){
		$base_url=$this->config->item('base_url');
		$this->session->sess_destroy();
		header('Location: '.$base_url);
	}
	function fblogin(){
		$this->config->load('facebook');
		$this->load->library('facebook');
		$user = array();
        $user = $this->facebook->getUser();
		pr($user);
		if ($user)
		{
			try{
				$user_profile = $this->facebook->api('/me?fields=id,first_name,last_name,name,email,gender,picture.width(500)');
				pr($user_profile);
				$fbid = $user_profile['id'];
				$params = array('next' => $base_url.'fbci/logout');
				$ses_user=array('User'=>$user_profile,
				   'logout' =>$facebook->getLogoutUrl($params)
				);
		        $this->session->set_userdata($ses_user);
				header('Location: '.$base_url);
			}catch(FacebookApiException $e){
				error_log($e);
				$user = NULL;
			}		
		}	
	}
	
}