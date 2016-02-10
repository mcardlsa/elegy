<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('user_auth');
		$this->load->model('User_model');
		$this->load->library("pagination");
	}
    
    public function index()
    {   
    	$view_data['title'] = 'Home';
    	$this->load->view('elements/header',$view_data);
		$this->load->view('index');
		$this->load->view('elements/footer');
    }
	
	/**
	 * Activate Acocunt	 *
	 * @return void
	 */
   public function activateaccount($activationCode)
	{
		$data['activationCode']= $activationCode;
	
		 $result=$this->User_model->activate_account($data);
		 echo $result['message'];
	}
  
  
  /**
	 * Reset Password with email
	 *
	 * @param var,var
	 */
	public function ResetPassword($userTokenKey,$resetTokenKey)
	{ 
	   
		
		$view_data=array();
		$view_data['title'] = 'Reset Password';
        $data = array();
		$data['userTokenKey'] = $userTokenKey;
		$data['resetTokenKey'] = $resetTokenKey;
          	
		
		if($this->User_model->check_user_token($userTokenKey))
		{
	
		$response = $this->User_model->check_reset_password_token($userTokenKey,$resetTokenKey);
		if($response['status']==200)
		{

		$this->form_validation->set_rules('password', 'Password', 
		'trim|required|min_length[8]|xss_clean');
		$this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'trim|required|min_length[8]|xss_clean|matches[password]');


		if ($this->form_validation->run())
		{
		
		$data['password'] = $this->form_validation->set_value('password');	

		$response = $this->User_model->Reset_password($data);
		if($response['status']==200)
		{
		$this->session->set_flashdata('success_msg', $response['message']);
	    redirect('user/ResetPassword/'.$userTokenKey."/". $resetTokenKey);
		}
		else
		{
	    $this->session->set_flashdata('error_msg', $response['message']);
		}					
		}
					
		
		}
		else
		{
		
		$this->session->set_flashdata('error_msg', $response['message']);
		}
		}
		else
		{
		
		$this->session->set_flashdata('error_msg', 'User token is invalid.');
		}
		if($this->user_auth->is_logged_in())
		{
		$data=$this->session->userdata('userInfo');
	    $groupId= $data->groupId; 
		$view_data['groupId']=$groupId;	
		}
		//pr($data);
	    $this->load->view('elements/header',$view_data);
		$this->load->view('user/reset_password',$data);
		$this->load->view('elements/footer');
	
		
		
}

/**
	 * Login user
	 *
	 * @return void
	 */
    public function login()
	{		
		$view_data = array();
		$data=array();
		$view_data['title']='LogIn';
		$this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
	    $this->form_validation->set_rules('emailId', 'emailId', 'trim|required|xss_clean|callback_email_check');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$view_data['errors'] = array();
			
		if ($this->form_validation->run()) {
									// validation ok
		$result = $this->user_auth->login(
		$this->form_validation->set_value('emailId'),
		$this->form_validation->set_value('password')
		);	
		if ($result) {								// success
		$data=$this->session->userdata('userInfo');
		
		$roleId=$data->roleId;	
        
		if($roleId == 2)
		{
			  $origin_after_login = $this->session->userdata('user_auth_origin_after_login');
			  $this->session->set_userdata(array('user_auth_origin_after_login'=> ''));
			  $redirect = (!empty($origin_after_login)) ? $origin_after_login : site_url('user');
			  redirect($redirect);

		}
		
		if($roleId == 1);
		{
			$origin_after_login = $this->session->userdata('user_auth_origin_after_login');
			$this->session->set_userdata(array('user_auth_origin_after_login'=> ''));
			$redirect = (!empty($origin_after_login)) ? $origin_after_login : site_url('funeral/find_funeral');
			redirect($redirect);
		}

        } else {
		
		$this->session->set_flashdata('error_msg', 'username and password is wrong' );	
		redirect('user/login');	
		}
		}
		
		
		$this->load->view('elements/header',$view_data);
		$this->load->view('user/login',$view_data);
		$this->load->view('elements/footer');
		
	}


	/**
	 * Logout user
	 *
	 * @return void
	 */
    public function logout()
	{
		$this->load->library('facebook');
      	$this->facebook->destroySession();
		$this->user_auth->logout();
		$this->session->set_flashdata('success_msg', $this->lang->line('auth_message_logged_out'));
		redirect('/user');
	}

	public function register()
	{
		$view_data = array();
		$data=array();
		$view_data['title']='Register';
		
		$this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
	 	$this->form_validation->set_rules('emailId', 'emailId', 'trim|required|xss_clean|callback_email_check');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$view_data['errors'] = array();
		if($this->form_validation->run())
		{
			$fields = array(
			'emailId'=>$this->form_validation->set_value('emailId'),
		    'password'=>$this->form_validation->set_value('password'));
		    $param = $this->input->post();
		    $data = $this->User_model->user_register_web($param);
		    if($data['status']==200){

		    	$email=$data['userInfo']['emailId'];
		    	$pass=$data['userInfo']['password'];
		    	$result = $this->user_auth->login($email,$pass);
		    	
		    	if ($result) {
					redirect('funeral/find_funeral');
		   		}
			}else {
				$this->session->set_flashdata('error_msg', $data['message']);
				redirect('user/register');
			}
		}
        $this->load->view('elements/header',$view_data);
		$this->load->view('user/register',$view_data);
		$this->load->view('elements/footer');
	}
     
    function email_check($str)
	{    
		$email=$str;
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
	   		return true;
	    }else {
	        $this->form_validation->set_message('email_check', 'Please enter valid email address.');
	        return FALSE;
	    }    	
	}
   	public function fblogin()
	{

        $this->config->load('facebook');
		$this->load->library('facebook');
		$user = array();
		$user = $this->facebook->getUser();
		if ($user) {

            try {
				$user_profile = $this->facebook->api('/me?fields=id,first_name,last_name,name,email,gender,picture.width(500)');
				$fbid = $user_profile['id'];           // To Get Facebook ID        
        
                //register fb user here if not exist.KS
                $flag = "";
                $flag =$this->User_model->check_user_exist($fbid);
               	if($flag == FALSE) {
                	$this->User_model->socialRegister($user_profile);
                	$this->user_auth->sociallogin($fbid);
					//$this->facebook->destroySession();
					redirect('user');
				}else{
					$this->user_auth->sociallogin($fbid);
					redirect('user');
				}
			} catch(FacebookApiException $e){
				error_log($e);
				$user = NULL;
			}

        } else {
			$login_url = $this->facebook->getLoginUrl();
			redirect($login_url);
		}

    }


    /**
	 * Change user Password with web
	 *
	 * @return void
	 */
	public function change_password()
	{
		if ($this->user_auth->is_logged_in())
		{
			$result=array();   
			$data['title']='Account'; 
			$view_data=$this->session->userdata('userInfo');
			$userId=$view_data->userId; 								
			$this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
	        $this->form_validation->set_rules('password1', 'OldPassword', 'trim|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean');
			$this->form_validation->set_rules('fname', 'First Name', 'trim|xss_clean');
			$this->form_validation->set_rules('lname', 'Last Name', 'trim|xss_clean');
			$data['errors'] = array();
			
			if ($this->form_validation->run()) {
				$data['password1']=$this->form_validation->set_value('password1');
				$data['password']=$this->form_validation->set_value('password');
				$data['firstName']=$this->form_validation->set_value('fname');
				$data['lastName']=$this->form_validation->set_value('lname');
				$data['userId']=$userId;
				$result = $this->User_model->changePassword($data);
			
			    if($result['status']==200) {
			    	
					$this->session->set_flashdata('success_msg', $result['message']);
					redirect('user/change_password/');	
				} else{
					
					$this->session->set_flashdata('error_msg', $result['message']);
					redirect('user/change_password/');			    
				}
			} else {
				$errors = $this->user_auth->get_error_message();
			}
			$data['info']=$this->User_model->userInfo($userId);
		    $this->load->view('elements/header',$data);
			$this->load->view('user/change_password',$data);
			$this->load->view('elements/footer');			
		} else {
			redirect('user/login/');	
		
        }
	} 

	/**
	 * Forget Password
	 *
	 * @return void
	 */
	
	public function forgot_password()
	{  
		$data['title']='ForgetPassword'; 
		if ($this->user_auth->is_logged_in()) {									
			redirect('');
		} else {
			$this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
		    $this->form_validation->set_rules('emailId', 'Email', 'trim|required|valid_email|xss_clean');
			$data['errors'] = array();
			if ($this->form_validation->run()) {
				$data['emailId']=$this->form_validation->set_value('emailId');
				$data['abc'] = $this->User_model->forget_password($data);
				if($data['abc']['status']==200) {	
				   	$this->session->set_flashdata('success_msg',$data['abc']['message']);
					redirect('user/login');
				} else {
					$this->session->set_flashdata('error_msg', $data['abc']['message']);
					redirect('user/forgot_password');
				}	
		    } else {
				$errors = $this->user_auth->get_error_message();
						
			}
			$this->load->view('elements/header',$data);
			$this->load->view('user/forget_password',$data);
			$this->load->view('elements/footer');			
		}
    }
}

