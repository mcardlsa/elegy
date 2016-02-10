<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class User extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('User_model');
	}

	/**
	* Function to register user/shelter account
	*
	* @author	KS
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function register_post()
	{ 
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('emailId','password');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } 
		else
        {
			$user=$this->User_model->user_register($data);
			if($user)
			{
				$this->response($user, 200); // 200 being the HTTP response code
			}
        }	
	}
	
	/**
	* Function to check social(facebook/twitter) account registration
	*
	* @author	KS
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function social_login_post()
	{ 
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('socialId', 'emailId');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } 
		else
        {
        	
			$user=$this->User_model->social_login($data);
			if($user)
			{
				$this->response($user, 200); // 200 being the HTTP response code
			}
        }	
	}
	
	
	
	/**
	* Function to login user account
	*
	* @author	KS
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function login_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('emailId','password');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } 
		else
        {
        	$data['password']	 = md5($data['password']);
			$user=$this->User_model->user_login($data);
			if($user)
			{
				$this->response($user, 200); // 200 being the HTTP response code
			}
        }	
	}
	
	/**
	* Function to retrieve forgot password link on user's email
	*
	* @author	KS
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function forget_password_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('emailId');		
		
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } 
		else
        {			
			$user=$this->User_model->forget_password($data);
			if($user)
			{	
				$this->response($user, 200); // 200 being the HTTP response code
			}
        }	
	}
	

	/**
	* Function to change the password of a user
	*
	* @author	Shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function change_password_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } 
		else
        {
			$userTokenStatus = $this->User_model->check_usertoken_validation($data);
			if($userTokenStatus['status'] == 200)
			{	
				if(isset($data['oldPassword'])){
				$data['password1']= $data['oldPassword'];
				}
				$data['userId'] = $this->User_model->get_user_id($data['userToken']);
				$userResult = $this->User_model->changePassword($data);
				if($userResult)
				{
					$this->response($userResult, 200); // 200 being the HTTP response code
				}
			}
			else
			{
				$this->response($userTokenStatus, 200); // 200 being the HTTP response code
			}	
        }	
	}
	
	/**
	* Function to retrieve forgot password link on user's email
	*
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function update_profile_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken');		
		
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } 
		else
        {	$userTokenStatus = $this->User_model->check_usertoken_validation($data);
			if($userTokenStatus['status'] == 200)
			{		
				$data['userId'] = $this->User_model->get_user_id($data['userToken']);
				$user=$this->User_model->update_profile($data);
				if($user) {	
					$this->response($user, 200); // 200 being the HTTP response code
				}
            } else {
				$this->response($userTokenStatus, 200); // 200 being the HTTP response code
			}
		}			
	}
	

	/**
	* Function to retrieve forgot password link on user's email
	*
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function user_setting_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken','isMemoryNotification','isScheduleNotification');		
		
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } 
		else
        {	$userTokenStatus = $this->User_model->check_usertoken_validation($data);
			if($userTokenStatus['status'] == 200)
			{		
				$data['userId'] = $this->User_model->get_user_id($data['userToken']);
				$user=$this->User_model->user_setting($data);
				if($user) {	
					$this->response($user, 200); // 200 being the HTTP response code
				}
            } else {
				$this->response($userTokenStatus, 200); // 200 being the HTTP response code
			}
		}			
	}
    
   /**
	* Function to logout user account
	*
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function logout_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken');
		
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } 
		else
        {
			$userTokenStatus = $this->User_model->check_usertoken_validation($data);
			if($userTokenStatus['status'] == 200)
			{
				$data['userId'] = $this->User_model->get_user_id($data['userToken']);
				$user = $this->User_model->logout_api($data);
				if($user)
				{
					$this->response($user, 200); // 200 being the HTTP response code
				}
			}
			else
			{
				$this->response($userTokenStatus, 200); // 200 being the HTTP response code
			}			
        }	
	}


}
?>
