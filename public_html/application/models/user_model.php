<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	private $user_table_name		= "users"; 			// main model table 	
	private $setting_table          = "user_settings";
	private $user_device_table      = "user_devices";
	private $anonymous_table        = "anonymous_user_device_token";
	public function __construct()
	{
		$this->load->model('Funeral_model');
	}
	
/**
	* Function to register user
	*
	* @author	KS
	* @param	array
	* @return	array
	*/	
	public function user_register_web($data)
	{
			
		$emailId 	= $data['emailId'];
		$password	= md5($data['password']);
		
		$profileImage    = !empty($data['profileImage']) ? $data['profileImage'] : "profile_image/default.png";		
		
		$sql_chk = "SELECT * FROM ".$this->user_table_name." WHERE emailId = '$emailId' and deleted=0";
		$res_chk = $this->db->query($sql_chk);
	
		if($res_chk->num_rows() > 0 && empty($data['socialId'])){
			$result['message'] = "This email id already registered. Please try to register with different email id.";
			$result['status'] = 202;
		}else {
			$user_fields['emailId'] = $emailId;
			$user_fields['password'] = $password;	
			$user_fields['profileImage'] = $profileImage;
			$user_fields['isActive'] = 1;
			// set unique user token
			$user_fields['userToken'] = randomToken(12, false, true, false);
			if($this->check_user_token($user_fields['userToken'])){
				$user_fields['userToken'] = $this->getNewUserToken();
			}
				$res_ins = $this->db->insert($this->user_table_name, $user_fields);
			    if($res_ins){
					$this->send_activation_code($data['emailId']);
				}
				$userId = $this->db->insert_id();
			    $userInfo['emailId'] = $emailId;
			    $userInfo['password'] = $data['password'];
			    $result['userInfo']= $userInfo;
			    $result['status'] = 200;
			}
			return $result;
	}

	/**
	* Function to register user
	*
	* @author	KS
	* @param	array
	* @return	array
	*/	
	public function user_register($data)
	{
			
		$emailId 	= $data['emailId'];
		$password	= md5($data['password']);
		
		$profileImage    = !empty($data['profileImage']) ? $data['profileImage'] : "profile_image/default.png";		
		
		$sql_chk = "SELECT * FROM ".$this->user_table_name." WHERE emailId = '$emailId' and deleted=0";
		$res_chk = $this->db->query($sql_chk);
	
		if($res_chk->num_rows() > 0 && empty($data['socialId'])){
			$result['message'] = "Already registered with this emailId.";
			$result['status'] = 202;	
		} else {
			$user_fields = array();
			
			if(!empty($data['socialId'])){
				$user_fields['facebookId']	= $data['socialId'];
			}
			
			if(!empty($data['firstName'])){
				$user_fields['firstName']	= $data['firstName'];
			}
			
			if(!empty($data['lastName'])){
				$user_fields['lastName'] = $data['lastName'];
			}
			if(isset($data['deviceType']) && $data['deviceType']!=''){
				$deviceType		= $data['deviceType'];
				$deviceToken	= $data['deviceToken'];	
			}
			
			$userId=0;
			$user_fields['emailId'] = $emailId;
			$user_fields['password'] = $password;	
			$user_fields['profileImage'] = $profileImage;
			// set unique user token
			$user_fields['userToken'] = randomToken(12, false, true, false);
			if($this->check_user_token($user_fields['userToken'])){
				$user_fields['userToken'] = $this->getNewUserToken();
			}
			if($res_chk->num_rows() ==0)
			{
			try{
			$res_ins = $this->db->insert($this->user_table_name, $user_fields);
			$userId = $this->db->insert_id();
			}
			catch (Exception $e) {
    		
    			
    			$result['message'] = $e->getMessage();
				$result['status'] = 202;
				return $result;	
			}
			$fields['isScheduleNotification']=1;
			$fields['isMemoryNotification']=1;
			$fields['createdTime']= date('Y-m-d H:i:s');
			$fields['userId']=$userId;
			$ins = $this->db->insert($this->setting_table, $fields);
			
			if(isset($data['deviceType']) && $data['deviceType']!=''){
				    $this->db->select("{$this->anonymous_table}.*");
					$this->db->where('deviceToken',$data['deviceToken']);
					$res_chk = $this->db->get($this->anonymous_table);
					if($res_chk->num_rows() < 0){
						$this->set_device_token($userId, $deviceType, $deviceToken);
					} else {
						$this->db->where('deviceToken', $data['deviceToken']);
						$this->db->delete($this->anonymous_table);
						$this->set_device_token($userId, $deviceType, $deviceToken);

					}	
			}
			}else
			{
			// user is coming from social login path.
			$this->db->where('emailId', $data['emailId']);
			try{
			$res_ins = $this->db->update($this->user_table_name, $user_fields);
			}
			catch (Exception $e) {
    		
    			
    			$result['message'] = $e->getMessage();
				$result['status'] = 202;
				return $result;	
			}
			
			}
			if($res_ins){
				
				$activationCode = $this->send_activation_code($data['emailId']);
				
				$result['activationCode'] = $activationCode;
				
				// Activate account immediately for now. No Email verification required at this stage.  This line will be removed later.
				$this->activate_account($result);
				$userInfo['userToken'] = $user_fields['userToken'];
				$userInfo['userId'] = $userId."";
				$userInfo['roleId'] = "1";// No use currently.
				
				

				if(!empty($data['firstName'])){
				$userInfo['firstName']	= $data['firstName'];
				}else
				{
				$userInfo['firstName']='';
				}
			
				if(!empty($data['lastName'])){
				$userInfo['lastName'] = $data['lastName'];
				}else
				{
				$userInfo['lastName'] ='';
				}
				$userInfo['emailId'] = $emailId;
				$userInfo['isActive'] = "1"; // Currently we are activating account immediately. 
				$userInfo['profileImage'] = $user_fields['profileImage'];
				$result['userInfo']= $userInfo;
				$result['funerals']= $this->Funeral_model->get_funeral_list($userInfo['emailId']);
				$result['serviceType']= $this->Funeral_model->get_service();
				$result['eventType']= $this->Funeral_model->get_eventType();
				$result['setting']=$this->get_setting($userId);
				
				
				$result['message'] = "Registered successfully. Activation link sent to your email";
				$result['status'] = 200;
			}else{
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
			}
		}
		return $result;
	}
	/**
	* Function For socialRegister
	* @author	Shashank
	* @param	none
	* @return	variable
	*/	
	public function socialRegister($param)
	{

		$fields['facebookId']=$param['id'];	
		$fields['firstName']=$param['first_name'];
		$fields['lastName']=$param['last_name'];
		if(isset($param['email'])){
		$fields['emailId']=$param['email'];
	    } 
	    if(isset($data['deviceType']) && $data['deviceType']!=''){
			$deviceType		= $data['deviceType'];
			$deviceToken	= $data['deviceToken'];	
		}
		$fields['isActive']=1;
		$fields['userToken'] = randomToken(12, false, true, false);
		if($this->check_user_token($fields['userToken'])){
			$fields['userToken'] = $this->getNewUserToken();
		}
		$res_ins = $this->db->insert($this->user_table_name, $fields);
		$userId = $this->db->insert_id();
		if(isset($data['deviceType']) && $data['deviceType']!=''){
			$this->set_device_token($userId, $deviceType, $deviceToken);
		}
			$fields['isScheduleNotification']=1;
			$fields['isMemoryNotification']=1;
			$fields['createdTime']= date('Y-m-d H:i:s');
			$fields['userId']=$userId;
			$ins = $this->db->insert($this->setting_table, $fields);
			$settingId=$this->db->insert_id();
		if($res_ins){
			$result['message'] = "Registered successfully";
			$result['status'] = 200;
		} else {
			$result['message'] = "There is something wrong, try after sometime.";
			$result['status'] = 202;

		}

	}
	/**
	* Function to generate and check usertoken in users table then return unique token
	*
	* @author	KS
	* @param	none
	* @return	variable
	*/	
	public function getNewUserToken() 
	{
		$userToken = randomToken(12, false, true, false);
		if($this->check_user_token($userToken)){
			$this->getNewUserToken();
		}		
		return $userToken;
    }
	
   	public function get_setting($id){
   		$this->db->select("{$this->setting_table}.*");
		$this->db->where('userId', $id);
		$response = $this->db->get($this->setting_table);
		return $response->result_array();
    }
	
	/**
	* Function to check usertoken validation in users table
	*
	* @author	KS
	* @param	array
	* @return	array
	*/
	public function check_usertoken_validation($param) 
	{
		$result = array();
		$flag = FALSE;
		
		$this->db->where('userToken', $param['userToken']);
		if($this->db->count_all_results($this->user_table_name) > 0){
			$flag = TRUE;
		}
		
		if($flag){
			$result['message'] = "Usertoken exist.";
			$result['status'] = 200;
		}else{
			$result['message'] = "Usertoken not valid.";
			$result['status'] = 202;
		}
		
		return $result;
    }
	
	
	
	/**
	* Function to check usertoken in users table
	*
	* @author	KS
	* @param	variable
	* @return	boolean
	*/
    public function check_user_token($userToken) 
	{
		$flag = FALSE;
    	if (empty($userToken))
		{
			return $flag;
		}	
		$this->db->where('userToken', $userToken);
		if($this->db->count_all_results($this->user_table_name) > 0){
			$flag = TRUE;
		}
		 
		return $flag;
    }
	
	/**
	* Function to send account activation code to user's email
	*=======
	* @author	Shashank
	* @param	variable
	* @return	none
	*/
	public function send_activation_code($emailId) 
	{
		$data['activation_code'] = randomToken(8, false, true, false);
		if($this->check_activation_code($data['activation_code'])){
			$data['activation_code'] = $this->getNewActivationToken();
		}
		$data['site_name'] = $this->config->item('site_name', 'user_auth');
		$data['name']='ElegyApp';
		$this->_send_email('activate', $emailId, $data, 'Account activation');
		$this->update_activation_code($emailId, $data['activation_code']);
		return $data['activation_code'];
	}
	
	/**
	* Function to generate and check activation code in users table then return unique code
	*
	* @author	KS
	* @param	none
	* @return	code variable
	*/
	public function getNewActivationToken() 
	{
		$activation_code = randomToken(8, false, true, false);
		if($this->check_activation_code($activation_code)){
			$this->getNewActivationToken();
		}		
		return $activation_code;
    }
	
	/**
	* Function to check activation code in users table
	*
	* @author	KS
	* @param	variable
	* @return	boolean
	*/
    public function check_activation_code($activation_code) 
	{
		$flag = FALSE;
    	if (empty($activation_code))
		{
			return $flag;
		}	
		$this->db->where('accountActivationCode', $activation_code);
		if($this->db->count_all_results($this->user_table_name) > 0){
			$flag = TRUE;
		}
		return $flag;
    }
	
	/**
	* Function to send email
	*
	* @author	Shashank
	* @param	view file type, email, array, subject
	* @return	none
	*/
	public function _send_email($type, $email, &$data, $subject)
	{
		$this->load->library('email');
		
		/*
		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.mail.yahoo.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'deepikagami@yahoo.com';
        $config['smtp_pass']    = 'manjuda';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);
		*/
		//$this->email->from($this->config->item('webmaster_email', 'user_auth'), $this->config->item('site_name', 'user_auth'));
		//$this->email->reply_to($this->config->item('webmaster_email', 'user_auth'), $this->config->item('site_name', 'user_auth'));
		if($type=='contact_us'){
			$this->email->from($email,$data['name']);
			$this->email->to('shashank.dixit@tanzaniteinfotech.com'); 
		} else {
			$this->email->from('shashank.dixit@tanzaniteinfotech.com',$data['name']);	
			$this->email->to($email);
		}


		$this->email->set_mailtype("html");
		//$this->email->subject("test Mail" );
		//$this->email->message("test mail");
		//$this->email->send();
		//$this->email->to($email);
		if($subject != '')
		{
			$this->email->subject($subject);
		}
		else
		{
			$this->email->subject($this->config->item('site_name', 'user_auth'));
		}
	//	$this->email->message("hii");
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));		
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
				
		$this->email->send();
		//echo $this->email->print_debugger();
		
		
		
		
	}
	
	/**
	* Function to activate user/shelter account
	*
	* @author	KS
	* @param	array
	* @return	array
	*/
	public function activate_account($data) 
	{
		if($this->check_activation_code($data['activationCode']))
		{
			$fields['isActive'] = 1;
			$this->db->where('accountActivationCode', $data['activationCode']);
			$res_ins = $this->db->update($this->user_table_name, $fields);
			if($res_ins)
			{				
				
					$result['message'] = "Your account activated successfully";
					$result['status'] = 200;
								
			}
			else
			{
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
			}
		}
		else
		{
			$result['message'] = "Activation Code does not exist.";
			$result['status'] = 202;
		}		
		return $result;
    }
	
	/**
	* Function to get userid from usertoken
	*
	* @author	KS
	* @param	variable
	* @return	variable
	*/
	public function get_user_id($userToken) 
	{
		$this->db->select("{$this->user_table_name}.userId");
		$this->db->where('userToken', $userToken);
		$result = $this->db->get($this->user_table_name);
		$userId = $result->row()->userId;
		return $userId;
    }
    
    
	
	
	
	/**
	* Function to get email from userId
	*
	* @author	KS
	* @param	variable
	* @return	variable
	*/
	public function get_email_by_user_id($userId) 
	{
		$emailId = '';
		$this->db->select("{$this->user_table_name}.emailId");
		$this->db->where('userId', $userId);
		$result = $this->db->get($this->user_table_name);
		if($result->num_rows()>0){
		$emailId = $result->row()->emailId;
		}
		return $emailId;
    }
   
    
    /**
	* Function to get email from user id
	*
	* @author	KS
	* @param	variable
	* @return	variable
	*/
	public function get_email_by_userToken($userToken) 
	{
		$emailId = '';
		$this->db->select("{$this->user_table_name}.emailId");
		$this->db->where('userToken', $userToken);
		$result = $this->db->get($this->user_table_name);
		if($result->num_rows()>0){
		$emailId = $result->row()->emailId;
		}
		return $emailId;
    }
	
	/**
	* Function to check social id (facebook/twitter) and return userinfo and petinfo
	*
	* @author	KS
	* @param	array
	* @return	array
	*/
	public function social_login($data) 
	{
		$flag = FALSE;
		$data['type']='facebook';// Currently only FB integration require in this version. In future we can come up with twitter also
		if(!empty($data['type']) && $data['type'] == 'facebook'){
			$this->db->where('facebookId', $data['socialId']);
			$this->db->where('emailId', $data['emailId']);
			if($this->db->count_all_results($this->user_table_name) > 0){
				$flag = TRUE;
			}
		}else if(!empty($data['type']) && $data['type'] == 'twitter'){
			$this->db->where('twitterId', $data['socialId']);
			$this->db->where('emailId', $data['emailId']);
			if($this->db->count_all_results($this->user_table_name) > 0){
				$flag = TRUE;
			}
		}
		
		if($flag){
			//get and send all pet information here .ks
			$whereCondition = "";
			if($data['type'] == 'facebook'){
				$whereCondition = " WHERE facebookId = '".$data['socialId']."' and deleted=0";
			}elseif($data['type'] == 'twitter'){
				$whereCondition = " WHERE twitterId = '".$data['socialId']."' and deleted=0";
			}
			$sql_chk_username = "SELECT userId,isActive,accountActivationCode,password FROM ".$this->user_table_name.$whereCondition ;
			$res_chk_username = $this->db->query($sql_chk_username);
			if($res_chk_username->num_rows() > 0)
			{
			$data['password']= $res_chk_username->row()->password;
			return $this->user_login($data);
			
			}else{
				$result['message'] = "Your account is deleted.";
				$result['status'] = 202;
			}
			
		}else{
		// Register user with auto generated password
			$data['password'] = randomToken(12, false, true, false);
			return $this->user_register($data);
			
		}
		return $result;
    }
	
	/**
	* Function to user login and return userinfo and petinfo
	*
	* @author	KS
	* @param	array
	* @return	array
	*/
	public function user_login($data)
	{
		$emailId	 =$data['emailId'];
		$password	 = $data['password'];		
		
		$sql_chk = "SELECT * FROM ".$this->user_table_name." WHERE emailId = '$emailId' AND password = '$password'";
		$res_chk = $this->db->query($sql_chk);
		if($res_chk->num_rows() == 0){
			$result['message'] = "Email or password is wrong.";
			$result['status'] = 202;
		}else if($res_chk->row()->isActive == 0){
			$result['activationCode'] = $res_chk->row()->accountActivationCode;
			$result['message'] = "Your account is not active.";
			$result['status'] = 201;
		}else if($res_chk->row()->deleted == 1){
			$result['message'] = "Your account has been deleted.";
			$result['status'] = 201;
		}else{			
			$row_chk = $res_chk->result();				
			//$result= $row_chk[0];
			
			$userInfo['userToken'] = $row_chk[0]->userToken;
			$userInfo['userId'] = $row_chk[0]->userId;
			$userInfo['roleId'] = $row_chk[0]->roleId;
			$userInfo['firstName'] = $row_chk[0]->firstName;
			$userInfo['lastName'] = $row_chk[0]->lastName;
			$userInfo['emailId'] = $row_chk[0]->emailId;
			$userInfo['isActive'] = $row_chk[0]->isActive;
			$userInfo['userToken'] = $row_chk[0]->userToken;
			$userInfo['profileImage'] = $row_chk[0]->profileImage;
			$result['userInfo']= $userInfo;
			$result['funerals']= $this->Funeral_model->get_funeral_list($userInfo['emailId']);
			$result['serviceType']= $this->Funeral_model->get_service();
			$result['eventType']= $this->Funeral_model->get_eventType();
			$updateTime = date('Y-m-d H:i:s');
			$sql_chk = "update ".$this->user_table_name." set lastLoginTime='".$updateTime."' WHERE userId = '".$userInfo['userId']."'";
			$this->db->query($sql_chk);
			if(isset($data['deviceType']) && $data['deviceType']!=''){
				$deviceType	 =$data['deviceType'];
				$deviceToken =$data['deviceToken'];
				$this->db->select("{$this->anonymous_table}.*");
					$this->db->where('deviceToken',$data['deviceToken']);
					$res_chk = $this->db->get($this->anonymous_table);
					if($res_chk->num_rows() < 0){
						$this->set_device_token($userInfo['userId'], $deviceType, $deviceToken);
					} else {
						$this->db->where('deviceToken', $data['deviceToken']);
						$this->db->delete($this->anonymous_table);
						$this->set_device_token($userInfo['userId'], $deviceType, $deviceToken);

					}	
				
			}
			$result['setting']= $this->get_setting($userInfo['userId']);
			$result['message'] = "Success.";
			$result['status'] = 200;
		}
		return $result;
	}
	
	
	
	
	/**
	* Function to get single user detail when login
	*
	* @author	KS
	* @param	array
	* @return	object row
	*/
	public function get_user_detail($param)
	{
		$this->db->select("{$this->user_table_name}.userToken,{$this->user_table_name}.userId,emailId,profileImage,screenName,aboutMe,shippingAddress,userAddress,userStreet,userCity,userState,userCountry,userZipcode,userWebLink,{$this->user_setting_table}.starNotification,hashtagNotification,messageNotification,followNotification");	
		$this->db->join($this->user_setting_table,"{$this->user_setting_table}.userId = .". $this->user_table_name.'.userId');		
		$this->db->where("{$this->user_table_name}.isActive",1);
		$this->db->where("{$this->user_table_name}.userId",$param['userId']);
		$response = $this->db->get($this->user_table_name);
		return $response->row();
	}
	
	/**
	* Function to get single user detail and send userid when viewing another user profile
	*
	* @author	KS
	* @param	array
	* @return	object row
	*/
	public function get_user_detail2($param)
	{
		$this->db->select("{$this->user_table_name}.userId,emailId,profileImage,screenName,aboutMe,shippingAddress,userAddress,userStreet,userCity,userState,userCountry,userZipcode,userWebLink,{$this->user_setting_table}.starNotification,hashtagNotification,messageNotification,followNotification");	
		$this->db->join($this->user_setting_table,"{$this->user_setting_table}.userId = .". $this->user_table_name.'.userId');		
		$this->db->where("{$this->user_table_name}.isActive",1);
		$this->db->where("{$this->user_table_name}.userId",$param['userId']);
		$response = $this->db->get($this->user_table_name);
		return $response->row();
	}



	/**
	* Function to update activation code to users table
	*
	* @author	KS
	* @param	emailId, activation_code
	* @return	none
	*/
	public function update_activation_code($emailId, $activation_code)
	{
		$sql_ins = "update ".$this->user_table_name." SET accountActivationCode='$activation_code'  where emailId='$emailId' and deleted=0";			
		$res_ins = $this->db->query($sql_ins);		
	}

	/**
	* Function to check reset password token with 24 hours validation
	*
	* @author	KS
	* @param	variable,variable
	* @return	array
	*/
	public function check_reset_password_token($userTokenKey,$resetTokenKey)
	{

		$sql_chk = "";
		$sql_chk = "SELECT resetPasswordTokenTime FROM ".$this->user_table_name." WHERE userToken = '$userTokenKey' and resetPasswordToken='$resetTokenKey'";
		$res_chk = $this->db->query($sql_chk);
		if($res_chk->num_rows() > 0){
			$timestamp = strtotime($res_chk->row()->resetPasswordTokenTime);			
			if(getHours($timestamp) <= 24){
				$result['message'] = "success";
				$result['status'] = 200;
			}else{
				$result['message'] = "Reset password token is invalid, try again.";
				$result['status'] = 202;
			}			
		}else{				
			$result['message'] = "Reset password token does not exist.";
			$result['status'] = 202;
		}
		return $result;
	}
	
	/**
	* Function to retrieve change password link on email
	*
	* @author	KS
	* @param	array
	* @return	array
	*/
	public function forget_password($data)
	{

		$emailId = $data['emailId'];
		$sql_chk = "SELECT userToken FROM ".$this->user_table_name." WHERE emailId = '$emailId'";
		$res_chk = $this->db->query($sql_chk);
		if($res_chk->num_rows() == 0){
			//echo 'Email does not Exist.';
			$result['message'] = "Email does not Exist.";
			$result['status'] = 202;
		
		}else{	
			$data['userToken'] = $res_chk->row()->userToken;
			$data['resettoken'] = randomToken(16, false, true, false);
			$data['site_name'] = $this->config->item('site_name', 'user_auth');
			$data['name']='ElegyApp';
			$this->_send_email('forgot-password', $emailId, $data, 'Password reset');
			$this->update_resetpassword_token($emailId, $data['resettoken']);
			//echo $this->db->last_query();
			$result['userToken']=$data['userToken'];
			$result['resettoken']=$data['resettoken'];
			$result['message'] = "Please check your email for the new password.";
			$result['status'] = 200;
		}
		return $result;
	}
	
	/**
	* Function to update reset password token to users table
	*=======
	* @author	KS
	* @param	emailId, token
	* @return	none
	*/
	public function update_resetpassword_token($emailId, $resettoken)
	{
		$time = date('Y-m-d h:i:s');
		$sql_ins = "update ".$this->user_table_name." SET resetPasswordToken='$resettoken',resetPasswordTokenTime='$time'  where emailId='$emailId'";			
		$res_ins = $this->db->query($sql_ins);		
	}
	
	/**
	* Function to logout from user account
	*
	* @author	KS
	* @param	userId, deviceToken
	* @return	array
	*/
	public function logout($data)
	{
		$this->db->where('userId', $data['userId']);
		$this->db->where('deviceToken', $data['deviceToken']);
		$this->db->delete($this->user_device_table);
		
		if($this->db->affected_rows() > 0)
		{
			$result['message'] = "User logged out successfully.";
			$result['status'] = 200;
		}
		else
		{
			$result['message'] = "There is something wrong, try after sometime.";
			$result['status'] = 202;
		}
		return $result;
	}	

	/**
	* Function to Reset password by email link
	*
	* @author	Shashank
	* @param	array
	* @return	array
	*/
	public function Reset_password($data)
	{
		$password	= md5($data['password']);
	    $fields['password'] = $password;
		$this->db->where('userToken', $data['userTokenKey']);
		$this->db->where('resetPasswordToken', $data['resetTokenKey']);
		$rslt = $this->db->update($this->user_table_name, $fields);
		if($rslt){
			$email= $this->get_email_by_userToken($data['userTokenKey']);
			$this->update_resetpassword_token($email, '');
			$result['message'] = "Password changed successfully.";
			$result['status'] = 200;
		}else{
			$result['message'] = "There is something wrong, try after sometime.";
			$result['status'] = 202;
		}
		return $result;	    
	}
	/**
	* Function to LISTING
	*
	* @author	Shashank
	* @param	var,var,var
	* @return	array
	*/
   public function all_users($limit, $start, $searchStr =NULL)
	{	 
	   
		if(isset($searchStr) && $searchStr != '' && $searchStr != NULL){
			$this->db->like('screenName', $searchStr,'after');
			$this->db->or_like('emailId', $searchStr,'after');
		}
		if($start!=0){
			$start = (($start-1) * $limit);
		}
		$this->db->limit($limit, $start);
		$this->db->order_by("userCreateTime", "desc");
        $this->db->where('groupId != 1');
		$this->db->where('groupId != 3');
		$query = $this->db->get($this->user_table_name);
		//echo $this->db->last_query();
		return $query->result_array();
	}
	


    /**
	 * Update user login info, such login time, and
	 * @author	Shashank
	 * @param	var
	 * 
	 * @return	void
	 */
	public function update_login_info($user_id)
	{
		$this->db->set('lastLoginTime', date('Y-m-d H:i:s'));
		$this->db->where('userId', $user_id);
		$this->db->update($this->user_table_name);
	}
	
	

	
    /**
	 * Update user status
	 * @author	Shashank
	 * @param var,var
	 * @return	void
	 */	
	function status_update($id,$data)
    {   
		$this->db->where('userId', $id);
		
		$this->db->update($this->user_table_name, $data);
		
    }


	
	/**
	* Function to get user profile with pet info
	*
	* @author	KS
	* @param	array
	* @return	array
	*/
	public function user_profile($param)
	{
		$userData = $this->get_user_detail2($param);		
		if(!empty($userData)){
			$result['userInfo'] = $userData;			
			$result['userInfo']->profileImage = base_url().$result['userInfo']->profileImage;			
			$this->load->model('Pet_model');
			$result['petInfo'] = $this->Pet_model->get_user_pets($param);
			foreach($result['petInfo'] as $key=>$value){
				$value->petImage = base_url().$value->petImage;
				$value->petImageThumb = base_url().$value->petImageThumb;
			}
			$result['message'] = "success";
			$result['status'] = 200;
		}else{
			$result['message'] = "No data found.";
			$result['status'] = 202;
		}
		return $result;	
	}


	/**
	* Function to change the password of user
	*
	* @author	KS
	* @param	array
	* @return	array
	*/
	public function change_password_api($data)
	{
		$userId		= $data['userId'];
		$password	= md5($data['password']);
		$oldPassword = md5($data['oldPassword']);
		
		// query to get the oldpassword
		$sql_sel = "SELECT password FROM ".$this->user_table_name." WHERE userId='$userId'";
		$res_sel = mysql_query($sql_sel);
		$row_sel = mysql_fetch_assoc($res_sel);
		$op = $row_sel['password'];
		if($oldPassword == $op){
			//query to update the user password
			$sql_upd = "UPDATE ".$this->user_table_name." SET password='$password' WHERE userId='$userId'";
			$res_upd = mysql_query($sql_upd);
			if($res_upd){
				$result['message'] = "Password change successfully.";
				$result['status'] = 200;
			}else{
				$result['message'] = "Unable to change password.";
				$result['status'] = 202;
			}
		}else{
			$result['message'] = "Old password did not match.";
			$result['status'] = 202;
		}		
		return $result;
	}
    




	
	/**
	* Function to get userid from screen name
	*
	* @author	KS
	* @param	variable
	* @return	variable
	*/
	public function get_user_id_by_email($email) 
	{
		$this->db->select("{$this->user_table_name}.userId");
		$this->db->where('email', $email);
		$result = $this->db->get($this->user_table_name);
		if ($result->num_rows() == 1) return $result->row();
		return NULL;
    }

    /**
	* Function to get userid from screen name
	*
	* @author	Shashank
	* @param	variable
	* @return	variable
	*/
	public function get_email_by_userId($userId) 
	{
		$this->db->select("{$this->user_table_name}.emailId");
		$this->db->where('userId', $userId);
		$result = $this->db->get($this->user_table_name);
		if ($result->num_rows() == 1) return $result->row();
		return NULL;
    }
	
	/**
	* Function to check user rest from screen name
	*
	* @author	Shashank
	* @param	variable
	* @return	variable
	*/
	public function check_user_exist($id) 
	{
		$this->db->select("{$this->user_table_name}.*");
		$this->db->where('facebookId', $id);
		$result = $this->db->get($this->user_table_name);
		if ($result->num_rows() > 0) {
			return TRUE;
		} else {	
			return FALSE;
	    } 
    }


    /**
	* Function to check user rest from screen name
	*
	* @author	Shashank
	* @param	variable
	* @return	variable
	*/
	public function user($id) 
	{
		$this->db->select("{$this->user_table_name}.*");
		$this->db->where('facebookId', $id);
		$result = $this->db->get($this->user_table_name);
		$row_chk = $result->result();
		if ($result->num_rows() > 0) {
			$DATA['userInfo'] = $row_chk[0];
			$DATA['status'] = 200;
			return $DATA;
		} else {
			$DATA['status'] = 202;
			return $DATA;
	    } 
    }

	/**
	* Function to update user profile
	* @author	Shashank
	* @param	array
	* @return	array
	*/
	public function update_profile($data)
	{
		if(isset($data['firstName'])){
        $fields['firstName'] = $data['firstName'];
        }
        if(isset($data['lastName'])){
        $fields['lastName'] = $data['lastName'];
        } 
		if(isset($data['lastName']) || isset($data['firstName'])){
            $this->db->where("{$this->user_table_name}.userId",$data['userId']);
            $res_ins = $this->db->update($this->user_table_name, $fields);
		}   
	        $userInfo= $this->userInfo($data['userId']);	
			//pr($userInfo);
			if($res_ins){
				$result['userinfo']= $userInfo;
				$result['funerals']= $this->Funeral_model->get_funeral_list($userInfo[0]->emailId);
				$result['serviceType']= $this->Funeral_model->get_service();
				$result['eventType']= $this->Funeral_model->get_eventType();
				$result['message'] = "update successfully.";
				$result['status'] = 200;
			}else{
				$result['message'] = "Unable to change password.";
				$result['status'] = 202;
			}
		
		return $result;
	}

	public function userInfo($id)
	{
		    $this->db->select("{$this->user_table_name}.userToken,userId,roleId,firstName,lastName,emailId,isActive,profileImage");
		    $this->db->where("{$this->user_table_name}.userId",$id);
		    $result = $this->db->get($this->user_table_name);
			return $result->result();
	}

	/**
	* Function to Lonin web
	*
	* @author	Shashank
	* @param	array
	* @return	array
	*/
	public function user_login_web($data)
	{
		$emailId	= $data['emailId'];
		$password	= md5($data['password']);
		
		
		$sql_chk = "SELECT * FROM ".$this->user_table_name." WHERE emailId = '$emailId' AND password = '$password'";
		$res_chk = $this->db->query($sql_chk);
		if($res_chk->num_rows() == 0){
			$result['message'] = "User does not exists.";
			$result['status'] = 202;
		} else if($res_chk->row()->isActive == 0){
			$result['message'] = "Your account is not active.";
			$result['status'] = 202;
		} else {
			$row_chk = $res_chk->result();
			unset($row_chk[0]->password);
			$userId = $row_chk[0]->userId;
			$row_chk[0]->profileImage = base_url().$row_chk[0]->profileImage;
			$result['userInfo'] = $row_chk[0];
			$result['status'] = 200;
		}
		
		return $result;
	}
	
    /**
	* Function to change password
	*
	* @author	Shashank
	* @param	array
	* @return	array
	*/
	public function changePassword($data)
	{
		
        $userId=$data['userId'];
        
        if(isset($data['firstName']) && isset($data['lastName']))
		{
			$field['firstName']=$data['firstName'];
			$field['lastName']=$data['lastName'];
			$this->db->where("{$this->user_table_name}.userId",$data['userId']);
	        $res_ins = $this->db->update($this->user_table_name, $field);
	        if($res_ins){
	        	$result['message'] = "Name updated successfully";
				$result['status'] = 200;
       		}
		}else if(isset($data['firstName'])){
			$field['firstName']=$data['firstName'];
			$this->db->where("{$this->user_table_name}.userId",$data['userId']);
	        $res_ins = $this->db->update($this->user_table_name, $field);
	        if($res_ins){
	        	$result['message'] = "Name updated successfully";
				$result['status'] = 200;
       		}

		}else if(isset($data['lastName'])){

			$field['lastName']=$data['lastName'];
			$this->db->where("{$this->user_table_name}.userId",$data['userId']);
	        $res_ins = $this->db->update($this->user_table_name, $field);
	        if($res_ins){
	        	$result['message'] = "Name updated successfully";
				$result['status'] = 200;
       		}
		}
		
        if(!empty($data['password'])){
        	$pass= md5($data['password1']);
			$password=md5($data['password']);
			$sql_sel = "SELECT password FROM ".$this->user_table_name." WHERE userId='$userId'";
			$res_sel = mysql_query($sql_sel);
			$row_sel = mysql_fetch_assoc($res_sel);
			$op = $row_sel['password'];
			$fields['password'] = $password;
			if($pass==$op)
			{
			$this->db->where('password', $pass);
			$this->db->where('userId', $userId);
			$rslt = $this->db->update($this->user_table_name, $fields);
			
			if($rslt){
					$result['message'] = "Password changed successfully.";
					$result['status'] = 200;
				}else{
					$result['message'] = "Unable to change password.";
					$result['status'] = 202;
				}
			}else{
				$result['message'] = "Old password did not match.";
				$result['status'] = 202;
			}
		}		
		return $result;
	}
	

	/**
	* Function to change the password of user
	*
	* @author	Shashank
	* @param	array
	* @return	array
	*/
	public function user_setting($data)
	{
		$userId=$data['userId'];
		$sql_chk = "SELECT * FROM ".$this->setting_table." WHERE userId = '$userId' ";
		$res_chk = $this->db->query($sql_chk);
        $fields['userId'] = $data['userId'];
        $fields['isMemoryNotification'] = $data['isMemoryNotification'];
        $fields['isScheduleNotification'] = $data['isScheduleNotification'];
        $fields['createdTime'] = date('Y-m-d H:i:s');	
		if($res_chk->num_rows() > 0 ){
		    
		    $this->db->where('userId', $userId);
			$res_ins = $this->db->update($this->setting_table, $fields);
			if($res_ins){
				
				$result['message'] = "success";
				$result['status'] = 200;
			}else{
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
			}

		}else {
			$res_ins = $this->db->insert($this->setting_table, $fields);
			if($res_ins){
				
				$result['message'] = "success";
				$result['status'] = 200;
			}else{
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
			}
		}
		return $result;
	}
  
    /**
	* Function to check and set device token
	*
	* @author	Shashank
	* @param	userid, devicetype, devicetoken
	* @return	none
	*/
	public function set_device_token($userId, $deviceType, $deviceToken)
	{

		$fields['deviceType']=$deviceType;
		$fields['deviceToken']=$deviceToken;
		$fields['userId'] =$userId;
		$fields['createdTime']=date('Y-m-d H:i:s');
		$res_ins = $this->db->delete($this->user_device_table, array('deviceToken' =>$deviceToken));
		$res_ins1 = $this->db->delete($this->user_device_table, array('userId' =>$userId));
		$sql_ins = $this->db->insert($this->user_device_table, $fields);	
			
		
	}

    /**
	* Function to logout from user account
	*
	* @author	shashank
	* @param	userId, deviceToken
	* @return	array
	*/
	public function logout_api($data)
	{
		$this->db->where('userId', $data['userId']);
		//$this->db->where('deviceToken', $data['deviceToken']);
		$this->db->delete($this->user_device_table);
		
		if($this->db->affected_rows() > 0)
		{
			$result['message'] = "User logged out successfully.";
			$result['status'] = 200;
		}
		else
		{
			$result['message'] = "There is something wrong, try after sometime.";
			$result['status'] = 202;
		}
		return $result;
	}	
   

    /**
	* Function to get device token information using userid
	*
	* @author	KS
	* @param	array
	* @return	array
	*/
	public function get_deviceinfo_by_userid($param)
	{
		$sql_sel = "";
		$sql_sel = "SELECT * FROM ".$this->user_device_table." WHERE userId='".$param['userId']."' order by udId desc";
		$res_chk = $this->db->query($sql_sel);
		if($res_chk->num_rows() != 0){
			$result = $res_chk->row();
		}else{
			$result = array();
		}			
		return $result;
	}

}
